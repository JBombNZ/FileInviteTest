require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Vuetify from 'vuetify/lib'

Vue.use(Vuetify)

const app = new Vue({
  el: '#app',
  vuetify: new Vuetify(),
});