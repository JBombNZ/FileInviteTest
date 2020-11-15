<template>
  <v-app>

    <v-navigation-drawer app>
      <v-list dense>

        <v-list-item link @click="navigate('/home')">
          <v-list-item-action>
            <v-icon>mdi-monitor-dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click="navigate('/bookings')">
          <v-list-item-action>
            <v-icon>mdi-calendar-month</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Bookings</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click="logout()">
          <v-list-item-action>
            <v-icon>mdi-logout</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Logout</v-list-item-title>
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

      //If this was a pure SPA then we would need to fetch CSRF cookie from Sanctum
      window.axios.get('/sanctum/csrf-cookie')
        .then((response) => {

          window.axios.get('/api/user')
            .then((response) => {

              this.$store.state.user.name = response.data.data.name
              this.$store.state.user.role = response.data.data.role

              return
            })
            .catch((error) => {
              return
            });

        })
        .catch((error) => {
          
        });
			
    },

    methods: {

      navigate (page) {
        this.$router.push({ path: page })
      },

      logout () {
        window.axios.get('/api/logout')
          .then((response) => {

            this.$store.state.user.name = ''
            this.$store.state.user.role = ''

            this.$router.push({ path: '/login' })

            return
          })
          .catch((error) => {

          });
      }

    }

  }
</script>