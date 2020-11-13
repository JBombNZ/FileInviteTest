require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify'
Vue.use(Vuetify)

import VueRouter from 'vue-router'
Vue.use(VueRouter)



import Main from './components/Main.vue';
Vue.component('main-layout', Main);

import Login from './components/Login.vue';
Vue.component('login', Login);

import Register from './components/Register.vue';
Vue.component('register', Register);

import Home from './components/Home.vue';
Vue.component('home', Home);

const routes = [
  { path: '/', component: Home },
	{ path: '/login', component: Login },
  { path: '/register', component: Register }
]


const router = new VueRouter({
  routes // short for `routes: routes`
})

const app = new Vue({
  el: '#app',
  router,
  vuetify: new Vuetify({
    theme: { dark: true },
  }),
});
