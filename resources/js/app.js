require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex';
import Store from './store';
import Velidate from 'vee-validate';
import Calendar from 'v-calendar';
import 'v-calendar/lib/v-calendar.min.css';
import FullCalendar from 'vue-full-calendar'


Vue.use(FullCalendar)
Vue.use(Calendar);
Vue.use(Vuex);
Vue.use(Velidate);

const store = new Vuex.Store(Store);

Vue.component('today', require('./components/Main-Today.vue'));
Vue.component('today-date', require('./components/Today-Date.vue'));
Vue.component('admin', require('./components/Main-Admin.vue'));
Vue.component('calendar', require('./components/Main-Calendar.vue'));

const app = new Vue({
    el: '#app',
    store,
    
});
