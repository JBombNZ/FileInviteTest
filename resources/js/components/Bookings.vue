<template>
  <div>

    <v-data-table
      :headers="headers"
      :items="bookings"
      :loading="loading"
	  :options.sync="options"
	  hide-default-footer
      class="elevation-1"
    >
		<template v-slot:item.actions="{ item }">
			
			<a @click="editItem(item.id)">
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
      v-model="page"
      :length="pagination.last_page"
	  :value="pagination.current_page"
	  total-visible="6"
    ></v-pagination>

  </div>
</template>

<script>
  export default {

	data () {
    	return {

			bookings: [],
			pagination: {},
			page: 1,
	        loading: true,
			options: {},
			parameters: {
				sortBy: '',
				sortDesc: '',
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

		}
	},

    mounted () {
	  
	  this.loadTable()

	},
	
	methods: {

		loadTable () {

			this.loading = true
			window.axios.get('/api/bookings?sortBy=' + this.parameters.sortBy + '&sortDesc=' + this.parameters.sortDesc)
				.then((response) => {

					this.bookings = response.data.data
					this.pagination = response.data.meta
					this.loading = false

				})
				.catch((error) => {
					return
				});

		},

		editItem () {

		},

		deleteItem (id) {
			window.axios.delete('/api/bookings/' + id)
				.then((response) => {
					this.loadTable()
				})
				.catch((error) => {
				});
		}

	},

	watch: {
      options: {
        handler () {
			console.log(this.options)
			if (this.options.sortBy.length > 0 && this.options.sortDesc.length > 0) {
				this.parameters.sortBy = this.options.sortBy[0]
				this.parameters.sortDesc = this.options.sortDesc[0]
				this.loadTable()
			}
        },
        deep: true,
      },
    },
	

  }
</script>