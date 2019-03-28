require('./bootstrap');
import Vue from 'vue';
import {store} from "./store/index.js";


Vue.config.productionTip = false;
Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('crops-table', require('./components/CropsTable.vue').default);
Vue.component('zones', require('./components/Zones').default);
Vue.component('regions', require('./components/Regions.vue').default);
Vue.component('districts', require('./components/Districts.vue').default);
Vue.component('years', require('./components/Years.vue').default);
Vue.component('crops', require('./components/Crops.vue').default);
Vue.component('livelihood_systems', require('./components/LivelihoodSystems.vue').default);


var app = new Vue({
    el: '#app',
    store,
    data() {
        return {}
    },

    created() {

    },


});

