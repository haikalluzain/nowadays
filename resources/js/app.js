require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex';
import Store from './store';
import Velidate from 'vee-validate';
import Calendar from 'v-calendar';
import 'v-calendar/lib/v-calendar.min.css';
import FullCalendar from 'vue-full-calendar'

// window.axios = require('axios');

// window.axios.defaults.headers.common = {
//     'X-Requested-With': 'XMLHttpRequest',
//     'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
// };

Vue.use(FullCalendar)
Vue.use(Calendar);
Vue.use(Vuex);
Vue.use(Velidate);

const store = new Vuex.Store(Store);

Vue.component('today', require('./components/Main-Today.vue').default);
Vue.component('today-date', require('./components/Today-Date.vue').default);
// Vue.component('Admin', require('./components/Main-Admin.vue'));
Vue.component('calendar', require('./components/Main-Calendar.vue').default);

const app = new Vue({
    el: '#app',
    store,
    
});
