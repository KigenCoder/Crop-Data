const state = {

  cropData: null,
  zones: [],
  regions: [],
  districts: [],
  seasons: [],
  clauses: [],
  where_clause: null,
  region_filter: '',
  districts_filter: '',
  seasons_filter: '',
  chart_region: '',

  filters: {
    where_zones: null,
    where_regions: null,
    where_districts: null,
    where_seasons: null,
    where_years: null,
    where_crops: null,
    where_livelihoods: null,
  },


}

const actions = {
  loadData({commit}) {
    axios
      .get('./api/data')
      .then(response => {
        commit('LOAD_DATA', response.data)
      })
      .catch(error => {
        console.log(error)
      })

  },

  loadFilteredData({commit}) {
    state.clauses = []
    let zoneFilter = state.filters.where_zones;
    let regionFilter = state.filters.where_regions
    let districtFilter = state.filters.where_districts
    let yearFilter = state.filters.where_years
    let cropsFilter = state.filters.where_crops
    let livelihoodsFilter = state.filters.where_livelihoods
    let seasonsFilter = state.filters.where_seasons

    if (zoneFilter) {
      state.clauses.push(zoneFilter)
    }
    if (regionFilter) {
      state.clauses.push(regionFilter)
    }
    if (districtFilter) {
      state.clauses.push(districtFilter)
    }

    if (yearFilter) {
      state.clauses.push(yearFilter)
    }

    if (seasonsFilter) {
      state.clauses.push(seasonsFilter)
    }

    if (cropsFilter) {
      state.clauses.push(cropsFilter)
    }
    if (livelihoodsFilter) {
      state.clauses.push(livelihoodsFilter)
    }

    for (var i = 0; i < state.clauses.length; i++) {

      let clause = state.clauses[i]

      if (i === 0) {
        state.where_clause = "WHERE " + clause
      } else {
        state.where_clause += " AND " + clause
      }
    }

    //console.log("Where clause: ", this.state.where_clause)

    axios
      .post('./api/filter', {
        filter: state.where_clause
      })

      .then(response => {
        commit('LOAD_DATA', response.data)
      })
      .catch(error => {
        console.log(error)
      })

  },

  loadZones({commit}) {
    axios
      .get('api/zones')
      .then(response => {
        commit('LOAD_ZONES', response.data)
      })
      .catch(error => {
        console.log(error)
      });
  },

  loadRegions({commit, dispatch}) {
    axios
      .post('api/regions', {
        zones: state.region_filter
      })
      .then(response => {
        commit('LOAD_REGIONS', response.data)

        let regionCount = state.regions.length

        let regionIds = ''
        for (var i = 0; i < regionCount; i++) {
          let currentRegion = state.regions[i]
          if (i === 0) {

            regionIds = currentRegion.id
          } else {
            regionIds += ", " + currentRegion.id
          }
        }

        state.districts_filter = regionIds

        dispatch('loadDistricts')

      })
      .catch(error => {
        console.log(error)
      });
  },


  loadDistricts({commit}) {
    axios
      .post('api/districts', {
        regions: state.districts_filter
      })
      .then(response => {
        commit('LOAD_DISTRICTS', response.data)
      })
      .catch(error => {
        console.log("Load districts: " + error)
      })
  },

  loadSeasons({commit}) {
    axios
      .get('api/seasons')
      .then(response => {
        commit('LOAD_SEASONS', response.data)
      })
      .catch(error => {
        console.log("Load seasons error: " + error)
      })
  },


}

const mutations = {
  //Load crop data
  LOAD_DATA(state, data) {
    state.cropData = data
  },
  //Load zones
  LOAD_ZONES(state, zones) {
    state.zones = zones
  },

  LOAD_REGIONS(state, regions) {
    state.regions = regions
  },


  LOAD_DISTRICTS(state, districts) {
    state.districts = districts
  },

  LOAD_SEASONS(state, seasons) {
    state.seasons = seasons
  },

// Crop data where cluase
  SET_WHERE_CLAUSE(state, where_clause) {
    state.where_clause = where_clause
  },

//Zones where clause
  WHERE_ZONES(state, where_zones) {
    state.filters.where_zones = where_zones
  },

//Regions where clause
  WHERE_REGIONS(state, where_regions) {
    state.filters.where_regions = where_regions
  },

//Districts where clause
  WHERE_DISTRICTS(state, where_districts) {
    state.filters.where_districts = where_districts
  },

//Districts where clause
  WHERE_SEASONS(state, where_seasons) {
    state.filters.where_seasons = where_seasons
  },

//Years where clause
  WHERE_YEARS(state, where_years) {
    state.filters.where_years = where_years
  },

//Crops where clause
  WHERE_CROPS(state, where_crops) {
    state.filters.where_crops = where_crops
  },

//Livelihoods where clause
  WHERE_LIVELIHOODS(state, where_livelihoods) {
    state.filters.where_crops = where_livelihoods
  },


  ADD_CLAUSES(state, clause) {
    state.clauses.push(clause)
  },
  REMOVE_CLAUSE(state, clause) {
    state.clauses.pop(clause)
  },

  REGION_FILTER(state, regionFilter) {
    state.region_filter = regionFilter
  },

  DISTRICTS_FILTER(state, districtFilter) {
    state.districts_filter = districtFilter
  },

  SEASONS_FILTER(state, seasonsFilter) {
    state.seasons_filter = seasonsFilter
  }
}

const getters = {
  zones: state => state.zones,
  regions: state => state.regions,
  districts: state => state.districts,
  seasons: state => state.seasons,
  seasonsClause: state => state.filters.where_seasons,
  filters: state => state.filters,
  clauses: state => state.clauses,
  regionFilter: state => state.region_filter,
  districtFilter: state => state.districts_filter,
  seasonsFilter: state => state.filters.where_seasons,
  yearsFilter: state => state.filters.where_years,
  cropsFilter: state => state.filters.where_crops,
  livelihoodsFilter: state => state.filters.where_livelihoods,
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}