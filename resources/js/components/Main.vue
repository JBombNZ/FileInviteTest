<template>
  <v-app>

  <v-navigation-drawer app>
    <!-- -->
  </v-navigation-drawer>

  <v-app-bar app>
    Meeting Room Booking App
  </v-app-bar>

  <!-- Sizes your content based upon application components -->
  <v-main>

    <!-- Provides the application the proper gutter -->
    <v-container fluid>

      <!-- If using vue-router -->
      <router-view></router-view>
    </v-container>
  </v-main>

  <v-footer app>
    <!-- -->
  </v-footer>

  </v-app>

</template>

<script>
  export default {

    data: () => ({
	    drawer: false,
    }),
    
    mounted () {
      
      //If this was a pure SPA then we would need to fetch CSRF cookie from Sanctum
      window.axios.get('/sanctum/csrf-cookie')
        .then((response) => {
          window.axios.get('/api/user')
            .then((response) => {
              return
            })
            .catch((error) => {
              return
            });
        })
        .catch((error) => {
          
        });
			
    }

  }
</script>