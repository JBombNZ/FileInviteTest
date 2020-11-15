<template>
  <div>

	<v-container>
		<v-row>
			
			<v-col cols="3">
				<v-select
					:items="rooms"
					label="Select Room"
					item-text="title"
					item-value="id"
					v-model="params.room"
					required
				></v-select>
			</v-col>


			<v-col cols="3">
				<v-menu
					ref="sortDateMenu"
					v-model="sortDateMenu"
					:close-on-content-click="false"
					:return-value.sync="params.date"
					transition="scale-transition"
					offset-y
					min-width="290px"
				>
					<template v-slot:activator="{ on, attrs }">
					<v-text-field
						v-model="params.date"
						label="Date of booking"
						prepend-icon="mdi-calendar"
						readonly
						v-bind="attrs"
						v-on="on"
					></v-text-field>
					</template>
					<v-date-picker
						v-model="params.date"
						:min="minDate"
						no-title
						scrollable
					>
					<v-spacer></v-spacer>
					<v-btn
						text
						color="primary"
						@click="sortDateMenu = false"
					>
						Cancel
					</v-btn>
					<v-btn
						text
						color="primary"
						@click="$refs.sortDateMenu.save(params.date)"
					>
						OK
					</v-btn>
					</v-date-picker>
				</v-menu>
			</v-col>

			<v-col cols="3" v-if="$store.state.user.role == 'User'">
				<v-checkbox
					v-model="params.userBookings"
					label="See only my bookings"
				></v-checkbox>
			</v-col>

			<v-col cols="3" v-if="$store.state.user.role == 'User'">

				<v-spacer></v-spacer>

				<v-btn
					color="blue darken-1"
					text
					@click="$refs.createBooking.dialog = true"
				>
					Create Booking
				</v-btn>

			</v-col>

		</v-row>
	</v-container>

    <v-data-table
      :headers="headers"
      :items="bookings"
      :loading="loading"
	  :options.sync="options"
	  hide-default-footer
      class="elevation-1"
    >
		<template v-slot:item.actions="{ item }">
			
			<a @click="editItem(item)">
				<v-icon small class="mr-2" v-if="item.user == $store.state.user.name">
					mdi-pencil
				</v-icon>
			</a>

			<a @click="deleteItem(item.id)">
				<v-icon small v-if="item.user == $store.state.user.name">
					mdi-delete
				</v-icon>
			</a>

    	</template>

	</v-data-table>

	<v-pagination
      v-model="params.page"
      :length="pagination.last_page"
	  :value="pagination.current_page"
	  total-visible="6"
    ></v-pagination>
	
    <book-room
	  ref="createBooking"
	  :rooms="rooms"
	  v-on:booking-created="loadTable()"
    ></book-room>

  </div>
</template>

<script>
  export default {

	data () {
    	return {

			bookings: [],
			rooms: [],
			pagination: {},
			page: 1,
			loading: true,
			options: {},
			sortDateMenu: false,
			editBooking: {},
			params: {
				sortBy: '',
				sortDesc: '',
				date: '',
				room: '',
				userBookings: false,
				page: 1
			},
        	headers: [
				{
					text: 'Room',
					align: 'start',
					sortable: true,
					value: 'room',
				},
				{ 
					text: 'User',
					sortable: true,
					value: 'user' 
				},
				{
					text: 'Date',
					sortable: true,
					value: 'date'
				},
				{ 
					text: 'Time', 
					sortable: true,
					value: 'time' 
				},
				{ 
					text: 'Actions', 
					sortable: false,
					value: 'actions' 
				},
			],
			minDate: new Date().toISOString().substr(0, 10),

		}
	},

    mounted () {
		this.getRooms()
		this.loadTable()
	},
	
	methods: {

		loadTable () {

			this.loading = true
			window.axios.get('/api/bookings', { params: this.params } )
				.then((response) => {

					this.bookings = response.data.data
					this.pagination = response.data.meta
					this.loading = false

				})
				.catch((error) => {
					return
				});

		},

		getRooms () {
			window.axios.get('/api/rooms')
				.then((response) => {

					this.rooms = response.data.data
				
				})
				.catch((error) => {

				});
		},

		editItem (booking) {
			this.$refs.createBooking.model.room = booking.room_id
			this.$refs.createBooking.model.date = booking.js_date
			this.$refs.createBooking.model.time = booking.js_time
			this.$refs.createBooking.model.duration = booking.duration
			this.$refs.createBooking.model.id = booking.id
			this.$refs.createBooking.edit = true
			this.$refs.createBooking.dialog = true
		},

		deleteItem (id) {

			window.axios.delete('/api/bookings/' + id)
				.then((response) => {
					this.loadTable()
				})
				.catch((error) => {
				});

		},

		openCreateDialog () {
			this.editBooking = {}
			this.$refs.createBooking.dialog = true
		}

	},

	watch: {
      options: {
        handler () {
			
			if (this.options.sortBy.length > 0 && this.options.sortDesc.length > 0) {
				this.params.sortBy = this.options.sortBy[0]
				this.params.sortDesc = this.options.sortDesc[0]
			}

        },
        deep: true,
	  },
	  params: {
		handler () {
			this.loadTable()
        },
	  	deep: true,
	  },
    },
	

  }
</script>