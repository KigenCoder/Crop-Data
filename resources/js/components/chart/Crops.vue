<template>
  <ul>
    <li v-for="crop in crops">
      <input
          type="checkbox"
          v-bind:value="crop.id"
          v-model="selectedCrops"
          @change="cropsSelected()"
      >
      {{crop.crop}}
    </li>
  </ul>
</template>

<script>
  export default {
    data() {
      return {
        crops: [],
        selectedCrops: [],
      }
    },

    methods: {
      cropsSelected() {

        if (this.selectedCrops.length >0) {
          //Reset current data
          this.$store.commit('chart_data/mutateChartData', [])

          let cropsFilter = "c.crop_id IN (" + this.selectedCrops.toString() + ") "

          //Save selected crop(s)
          this.$store.commit('chart_data/mutateCropsFilter', cropsFilter)


          //check if region/district is set, then fetch data
          let districtId = this.$store.getters['chart_data/getDistrictId']
          let regionId = this.$store.getters['chart_data/getRegionId']

          if (districtId || regionId) {
            this.$store.dispatch('chart_data/loadChartData')
          }

        }

      }
    },


    created() {
      axios.get('./api/search_params').then(response => this.crops = response.data.crops);
    },


  }
</script>