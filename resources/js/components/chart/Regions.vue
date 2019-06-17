<template>
  <ul>
    <li v-for="region in regions">
      <input
          type="radio"
          v-bind:value="region.id"
          v-model="selectedRegion"
          @change="regionSelected()"
      >
      {{region.region}}
    </li>
  </ul>
</template>

<script>
  import {mapState} from 'vuex'

  export default {
    data() {
      return {
        //regions: [],
        selectedRegion: ''
      }
    },

    mounted() {
      this.$store.dispatch('tabular_data/loadRegions')
    },

    computed: {
      ...mapState('tabular_data', [
        'regions'
      ])

    },

    methods: {
      regionSelected() {
        //Reset current data
        this.$store.commit('chart_data/mutateChartData', [])

        //Update chart Vuex region ID
        this.$store.commit('chart_data/mutateRegionId', this.selectedRegion);

        //Get districts that belong to that region - Populate district list
        this.$store.dispatch('chart_data/loadDistricts')

        //Reset districtId
        this.$store.commit('chart_data/mutateDistrictId', null)



        //Fetch data - If crop data is set
        if (this.$store.getters['chart_data/getCropId']) {
          this.$store.dispatch('chart_data/loadChartData')
        }
      }
    }
  }
</script>