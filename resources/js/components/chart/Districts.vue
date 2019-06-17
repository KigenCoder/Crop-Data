<template>
  <ul>
    <li v-for="district in districts">
      <input
          type="radio"
          v-bind:value="district.id"
          v-model="selectedDistrict"
          @change="districtsSelected()"
      >
      {{district.district}}
    </li>
  </ul>

</template>


<script>
  import {mapState} from 'vuex'

  export default {
    data() {
      return {
        //districts: [],
        selectedDistrict: ''
      }
    },

    mounted() {
      //this.$store.dispatch('loadDistricts')
    },

    computed: {
      ...mapState('chart_data', [
        'districts'
      ])
    },

    methods: {
      districtsSelected() {
        //Reset current data
        this.$store.commit('chart_data/mutateChartData', [])

        //Set district
        this.$store.commit('chart_data/mutateDistrictId', this.selectedDistrict)

        //Check if crop ID is set, then get data

        //Fetch data - If crop data is set
        if (this.$store.getters['chart_data/getCropId']) {
          this.$store.dispatch('chart_data/loadChartData')
        }

      }

    }
  }
</script>