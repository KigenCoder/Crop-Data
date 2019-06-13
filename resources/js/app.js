require('./bootstrap');
import Vue from 'vue';
import {store} from "./store/index.js";


Vue.config.productionTip = false;
Vue.component('crops-table', require('./components/table/CropsTable.vue').default);
Vue.component('zones', require('./components/table/Zones.vue').default);
Vue.component('regions', require('./components/table/Regions.vue').default);
Vue.component('districts', require('./components/table/Districts.vue').default);
Vue.component('seasons', require('./components/table/Seasons.vue').default);
Vue.component('years', require('./components/table/Years.vue').default);
Vue.component('crops', require('./components/table/Crops.vue').default);
Vue.component('livelihood_systems', require('./components/table/LivelihoodSystems.vue').default);

//Chart components
Vue.component('chart-regions', require('./components/chart/Regions.vue').default);
Vue.component('chart-districts', require('./components/chart/Districts.vue').default);
Vue.component('chart-crops', require('./components/chart/Crops.vue').default);
Vue.component('chart-seasons', require('./components/chart/Seasons.vue').default);
Vue.component('chart-data', require('./components/chart/ChartData.vue').default);


var app = new Vue({
    el: '#app',
    store,
    data() {
        return {}
    },

    created() {

    },


});

