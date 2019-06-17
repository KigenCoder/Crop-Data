<template>

  <ul>
    <li v-for="season in seasons">
      <input
          type="checkbox"
          v-bind:value="season.id"
          v-model="selectedSeasons"
          @change="seasonSelected()"
      >
      {{season.season}}
    </li>
  </ul>
</template>

<script>
  import {mapState} from 'vuex'

  export default {
    data() {
      return {
        selectedSeasons: []
      }
    },

    mounted() {
      this.$store.dispatch('tabular_data/loadSeasons')
    },

    computed: {
      ...mapState('tabular_data', [
        'seasons'
      ])

    },

    methods: {
      seasonSelected() {

        if (this.selectedSeasons.length > 0) {

          let seasonsFilter = "c.season_id IN (" + this.selectedSeasons.toString() + ") "
          //console.log(seasonsFilter)
          this.$store.commit('chart_data/mutateSeasonsFilter', seasonsFilter)

        } else {
          this.$store.commit('chart_data/mutateSeasonsFilter', '')
        }

        let getters = this.$store.getters
        let cropsFilter  = getters['chart_data/getCropsFilter']
        let regionId = getters['chart_data/getRegionId']
        let districtId = getters['chart_data/getDistrictId']



        if(cropsFilter && (regionId || districtId)){
          this.$store.dispatch('chart_data/loadChartData')
        }


      }


    }
  }
</script>

