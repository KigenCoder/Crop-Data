<template>
    <div class="clusterize">
        <table class="table is-bordered is-narrow small-font">
            <thead>
            <th scope="col">Zone</th>
            <th scope="col">Region</th>
            <th scope="col">District</th>
            <th scope="col">Year</th>
            <th scope="col">Crop</th>
            <th scope="col">Livelihood System</th>
            <th scope="col">Season</th>
            <th scope="col">production</th>
            <th scope="col">off season prod'n</th>
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
                <td>{{item.season_production}}</td>
                <td>{{item.off_season_production}}</td>
            </tr>
            </tbody>
        </table>
    </div>
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
            ])

        },


    }


</script>

