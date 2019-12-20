import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import routes from './routes';
import store from './store';

require('./bootstrap');
window.Vue = require('vue');

Vue.use(Vuex);
Vue.use(VueRouter);

Vue.component('main-vue', require('./components/App.vue').default);
Vue.component('warehouses', require('./components/Warehouses.vue'));
Vue.component('detailswarehouse', require('./components/Detailswarehouse.vue'));
Vue.component('location', require('./components/ManagerCoordinates.vue'));
Vue.component('rooms', require('./components/Rooms.vue'));
Vue.component('addwarehouseModal', require('./modals/AddWarehouseModal.vue'));
Vue.component('warehousedetailsModal', require('./modals/WarehouseDetailsModal.vue'));

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    store: new Vuex.Store(store)
});