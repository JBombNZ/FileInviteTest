<template>

  <div>

    Rooms

  </div>

</template>

<script>
  export default {

    mounted () {
	  console.log(this.$store.state)
	  
	  this.loadTable()

	},
	
	methods: {

		loadTable () {

			window.axios.get('/api/bookings')
				.then((response) => {

					

				return
				})
				.catch((error) => {
				return
				});

		}

	}

  }
</script>