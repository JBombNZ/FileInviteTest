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

        <v-list-item link @click="$refs.bookRoom.dialog = true">
          <v-list-item-action>
            <v-icon>mdi-vhs</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Book A Room</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click="navigate('/bookings')">
          <v-list-item-action>
            <v-icon>mdi-vhs</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Bookings</v-list-item-title>
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

    <!-- Sizes your content based upon application components -->
    <book-room
      ref="bookRoom"
    ></book-room>

  </v-app>

</template>

<script>
  export default {

    data: () => ({
      drawer: false,
      dialogs: {
        bookRoom: false
      }
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

      openBookRoomDialog() {
        this.$refs.bookRoom.dialog = true
      }

    }

  }
</script>