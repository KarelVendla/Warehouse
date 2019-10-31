import Vue from 'vue';

import VueRouter from 'vue-router';

import routes from './routes';

import warehouses from './components/Warehouses';
import detailswarehouse from './components/Detailswarehouse';
import location from './components/ManagerCoordinates';
import rooms from './components/Rooms';
Vue.component('warehouses', require('./components/Warehouses.vue').default);
Vue.component('detailswarehouse', require('./components/Detailswarehouse.vue').default);
Vue.component('location', require('./components/ManagerCoordinates.vue').default);
Vue.component('rooms', require('./components/Rooms.vue').default);

require('./bootstrap');


Vue.use(VueRouter);
window.Vue = require('vue');



let app = new Vue({
    el: '#app',

    router: new VueRouter(routes)
});