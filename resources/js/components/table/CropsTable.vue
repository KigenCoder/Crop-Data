<template>
  <table class="table is-bordered is-striped is-narrow small-font is-size-7">
    <thead>
    <th scope="col">Zone</th>
    <th scope="col">Region</th>
    <th scope="col">District</th>
    <th scope="col">Year</th>
    <th scope="col">Crop</th>
    <th scope="col">Livelihood System</th>
    <th scope="col">Season</th>
    <th scope="col">Production (Metric tones)</th>
    </thead>
    <tbody>

    <tr v-for="item in cropData" v-bind:key="item.id" v-bind:item="item">
      <td>{{item.zone}}</td>
      <td>{{item.region}}</td>
      <td>{{item.district}}</td>
      <td>{{item.year}}</td>
      <td>{{item.crop}}</td>
      <td>{{item.livelihood_system}}</td>
      <td>{{item.season}}</td>
      <td style="text-align: right">
           {{ production(item.season_production, item.off_season_production)}}
      </td>
    </tr>
    </tbody>
  </table>

</template>

<script>
  import {mapState} from 'vuex'

  export default {

    data() {
      return {}
    },

    mounted() {
      this.$store.dispatch('tabular_data/loadData');
    },

    computed: {
      ...mapState('tabular_data', [
        'cropData'
      ]),
    },

    methods: {
      production(season, off_season) {

        season = +season
        off_season = +off_season

        if (isNaN(season)) {
          season = 0
        }

        if (isNaN(off_season)) {
          off_season = 0
        }
        return Math.round(season + off_season).toLocaleString()
      },

    },


  }


</script>

