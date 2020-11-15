<template>

  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >

      <v-card v-if="allowed">
        <v-card-title>
          <span class="headline">Book a Room</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
             
				<v-col cols="12">
					<v-select
						:items="rooms"
						label="Select Room"
						item-text="title"
						item-value="id"
						v-model="model.room"
						required
                	></v-select>
				</v-col>


              <v-col cols="12">
                    <v-menu
						ref="menu"
						v-model="menu"
						:close-on-content-click="false"
						:return-value.sync="model.date"
						transition="scale-transition"
						offset-y
						min-width="290px"
					>
						<template v-slot:activator="{ on, attrs }">
						<v-text-field
							v-model="model.date"
							label="Date of booking"
							prepend-icon="mdi-calendar"
							readonly
							v-bind="attrs"
							v-on="on"
						></v-text-field>
						</template>
						<v-date-picker
							v-model="model.date"
							:min="minDate"
							no-title
							scrollable
						>
						<v-spacer></v-spacer>
						<v-btn
							text
							color="primary"
							@click="menu = false"
						>
							Cancel
						</v-btn>
						<v-btn
							text
							color="primary"
							@click="$refs.menu.save(model.date)"
						>
							OK
						</v-btn>
						</v-date-picker>
					</v-menu>
              </v-col>

              	<v-col cols="12">
					<v-time-picker
						v-model="model.time"
						min="08:00"
						max="17:00"
						:landscape="$vuetify.breakpoint.smAndUp"
						ampm-in-title
					></v-time-picker>
				</v-col>

				<v-col cols="12">

					<v-radio-group v-model="model.duration">
						<v-radio
							key="0.5"
							label="30 Minutes"
							value="30"
						></v-radio>
						<v-radio
							key="1"
							label="1 Hour"
							value="60"
						></v-radio>
					</v-radio-group>
					
				</v-col>

			</v-row>
          </v-container>
          
        </v-card-text>

        <v-card-text v-if="errors">
          <v-container>
            {{ errors }}
          </v-container>
        </v-card-text>

        <v-card-actions>

          <v-spacer></v-spacer>

          <v-btn
            color="blue darken-1"
            text
            @click="dialog = false"
          >
            Cancel
          </v-btn>

          <v-btn
            color="blue darken-1"
            text
            @click="submit()"
          >
            Book
          </v-btn>

        </v-card-actions>

      </v-card>

	  <v-card v-else>

        <v-card-title>
          <span class="headline">Denied</span>
        </v-card-title>

        <v-card-text>
			Guests cannot book rooms
        </v-card-text>

		<v-card-actions>
			<v-spacer></v-spacer>
			<v-btn
            color="blue darken-1"
            text
            @click="dialog = false"
          >
            Ok
          </v-btn>

		</v-card-actions>

	  </v-card>

    </v-dialog>
  </v-row>

</template>

<script>
  export default {

    data: () => ({
	  date: new Date().toISOString().substr(0, 10),
	  minDate: new Date().toISOString().substr(0, 10),
      menu: false,
	  rooms: [],
	  dialog: false,
      model: {
		room: null,
		date: null,
		time: null,
		duration: null
      },
      errors: ''
    }),
  
    mounted () {
    },

	watch: {
		// Refresh the room when we 
		dialog: function (val) {
			if (val == true) {
				window.axios.get('/api/rooms')
					.then((response) => {

						this.rooms = response.data.data
					
					})
					.catch((error) => {

					});
			}
		},
	},
	  
	computed: {
		allowed: function () {
			if (this.$store.state.user.role == 'User') {
				return true
			}
			return false
		}
	},

    methods: {

      submit () {

		window.axios.post('/api/bookings', this.model)
			.then((response) => {

				console.log(response)
				if (response.data.success) {
					this.$router.push({ path: '/bookings' })
				}
				else {
					this.errors = response.data.message
				}
			
			})
			.catch((error) => {

				if (error.response.status == 422) {
					// The information for each fields error is in here but will skip for a test
					this.errors = error.response.data.message
				}

			});


      }

    }

  }
</script>
