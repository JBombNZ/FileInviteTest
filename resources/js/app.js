require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify'
Vue.use(Vuetify)


import Main from './components/Main.vue';
Vue.component('main-layout', Main);

import Login from './components/Login.vue';
Vue.component('login', Login);

import Register from './components/Register.vue';
Vue.component('register', Register);

import Home from './components/Home.vue';
Vue.component('home', Home);

import Rooms from './components/Rooms.vue';
Vue.component('rooms', Rooms);

import BookRoom from './components/BookRoom.vue';
Vue.component('book-room', BookRoom);


import VueRouter from 'vue-router'
Vue.use(VueRouter)

const routes = [
  { path: '/home', component: Home },
	{ path: '/login', component: Login },
  { path: '/register', component: Register },
  { path: '/rooms', component: Rooms },

]

const router = new VueRouter({
  routes // short for `routes: routes`
})

import axios from 'axios'

window.axios = axios.create({
    //baseURL: '', //We dont need to set this in this dev environment
    timeout: 10000,
    credentials: true,
    params: {} // do not remove this, its added to add params later in the config
});

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;

window.axios.interceptors.response.use((response) => {

  console.log(response)

  return response;
}, (error) => {
  
  // Take them to the login page if they are ever not logged in
  if (error.response.status == 401) {
    router.push({ path: '/login' })
  }

  return Promise.reject(error);
});


import Vuex from 'vuex'
Vue.use(Vuex)

const store = new Vuex.Store({

  state: {
    user: {
      name: '',
      role: ''
    }
  }

})

const app = new Vue({
  el: '#app',
  router,
  vuetify: new Vuetify({
    theme: { dark: true },
  }),
  store: store,
});
