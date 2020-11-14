<template>

  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >

      <v-card>
        <v-card-title>
          <span class="headline">Register</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
             
              <v-col cols="12">
                <v-text-field
                  label="Name"
                  v-model="model.name"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12">
                <v-text-field
                  label="Email"
                  v-model="model.email"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Password"
                  v-model="model.password"
                  type="password"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12">
                <v-text-field
                  label="Confirm Password"
                  v-model="model.password_confirmation"
                  type="password"
                  required
                ></v-text-field>
              </v-col>

              <v-col
                cols="12"
                sm="6"
              >
                <v-select
                  :items="['User', 'Guest']"
                  label="Role"
                  v-model="model.role"
                  required
                ></v-select>
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
            @click="submit()"
          >
            Register
          </v-btn>

        </v-card-actions>

      </v-card>
    </v-dialog>
  </v-row>

</template>

<script>
  export default {
    data: () => ({
      dialog: true,
      model: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
        role: null
      },
      errors: ''
    }),
  
    mounted () {

    },

    methods: {

      submit () {

      window.axios.post('/register', this.model)
        .then((response) => {

          console.log(response)
          if (response.data.success) {
            this.$router.push({ path: '/login' })
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
