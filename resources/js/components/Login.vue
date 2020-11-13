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
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Password"
                  type="password"
                  required
                ></v-text-field>
              </v-col>
             </v-row>
          </v-container>
          
        </v-card-text>

        <v-card-actions>

          <v-btn
            color="blue darken-1"
            text
            href="/register"
          >
            Register
          </v-btn>

          <v-spacer></v-spacer>

          <v-btn
            color="blue darken-1"
            text
            @click="dialog = false"
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
	    dialog: true
    }),
  
    mounted () {

      //If this was a pure SPA then we would need to fetch CSRF cookie from Sanctum
      window.axios.get('/sanctum/csrf-cookie')
        .then((response) => {

        })
        .catch((error) => {
          
        });
        
    }



  }
</script>