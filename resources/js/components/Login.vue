<template>

  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >

      <v-card>
        <v-card-title>
          <span class="headline">Login</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
             
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
             </v-row>
          </v-container>
          
        </v-card-text>

        <v-card-text v-if="errors">
          <v-container>
            {{ errors }}
          </v-container>
        </v-card-text>

        <v-card-actions>

          <v-btn
            color="blue darken-1"
            text
            @click="register()"
          >
            Register
          </v-btn>

          <v-spacer></v-spacer>

          <v-btn
            color="blue darken-1"
            text
            @click="login()"
          >
            Login
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
        email: '',
        password: ''
      },
      errors: ''
    }),
  
    mounted () {

    },

    methods: {

      register () {
        this.$router.push({ path: '/register' })
      },
      
      login () {
        window.axios.post('/login', this.model)
        .then((response) => {

          console.log(response)
          
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.message
          }
        });
      }

    }



  }
</script>