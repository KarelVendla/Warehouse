import Vue from 'vue'
import Warehouses from './components/Warehouses'
import Detailswarehouse from './components/Detailswarehouse'


require('./bootstrap');

window.Vue = require('vue');

Vue.component('Warehouses', require('./components/Warehouses.vue').default);
Vue.component('Detailswarehouse', require('./components/Detailswarehouse.vue').default);


const app = new Vue({
    el: '#app',
})