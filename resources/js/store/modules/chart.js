const state = {
  cropId: '',
  regionId: '',
  districtId: '',
  districts: [],
  cropIds: [],
  chartData: [],
  seasonsFilter: '',
}
const actions = {

  loadDistricts({commit}) {
    let regionClause = '(' + state.regionId + ')'

    axios
      .post('./api/districts', {
        regions: regionClause
      })
      .then(response => {
        commit('mutateDistricts', response.data)
      })
      .catch(error => {
        console.log("Chart districts: " + error)
      })
  },

  //Load chart data
  loadChartData({commit}) {
    console.log(state.seasonFilter)
    axios
      .post('./api/chart-data', {
        region_id : state.regionId,
        district_id: state.districtId,
        crop_id: state.cropId,
        season_filter: state.seasonFilter,


      })
      .then(response => {
        commit('mutateChartData', response.data)
      })
      .catch(error => {
        console.log("Chart data error: " + error)
      })
  },

}
const mutations = {
  mutateChartData(state, chartData) {
    state.chartData = chartData
  },
  mutateDistricts(state, districts) {
    state.districts = districts

  },

  mutateCropId(state, cropId){
    state.cropId = cropId
  },

  mutateRegionId(state, regionId) {
    state.regionId = regionId
  },
  mutateDistrictId(state, districtId){
    state.districtId = districtId
  },
  mutateSeasonsFilter(state, seasonsFilter){
    state.seasonFilter = seasonsFilter
  }
}
const getters = {
  //zones: state => state.zones,
  getCropId: state=>state.cropId,
  getRegionId: state =>state.regionId,
  getDistrictId: state=>state.districtId,
  getChartData: state=>state.chartData,
  getSeasonsFilter: state =>state.seasonFilter
}


export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
