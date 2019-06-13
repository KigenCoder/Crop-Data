import Vue from "vue";
import Vuex from "vuex";
import  tabular_data from './modules/table.js'
import chart_data from   './modules/chart.js'

Vue.use(Vuex);

export const store = new Vuex.Store({
  modules: {
    tabular_data: tabular_data,
    chart_data: chart_data,
  },
});
