<template>
  <v-app>

  <v-navigation-drawer app>
    <v-list dense>

      <v-list-item link>
        <v-list-item-action>
          <v-icon>mdi-vhs</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Dashboard</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item link @click="navigate('/rooms')">
        <v-list-item-action>
          <v-icon>mdi-vhs</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Rooms</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item link>
        <v-list-item-action>
          <v-icon>mdi-vhs</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Book Room</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item link>
        <v-list-item-action>
          <v-icon>mdi-vhs</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>View Bookings</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

    </v-list>
  </v-navigation-drawer>

  <v-app-bar app>
    Meeting Room Booking App
  </v-app-bar>

  <!-- Sizes your content based upon application components -->
  <v-main>

    <!-- Provides the application the proper gutter -->
    <v-container fluid>
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
      
      window.axios.get('/api/user')
        .then((response) => {

          this.$store.state.user.name = response.data.data.name
          this.$store.state.user.role = response.data.data.role

          return
        })
        .catch((error) => {
          return
        });

      /*//If this was a pure SPA then we would need to fetch CSRF cookie from Sanctum
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
          
        });*/
			
    },

    methods: {

      navigate (page) {
        this.$router.push({ path: page })
      }

    }

  }
</script>