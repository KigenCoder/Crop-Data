<template>
    <table class="table is-bordered">
        <thead>
        <th scope="col">Zone</th>
        <th scope="col">Region</th>
        <th scope="col">District</th>
        <th scope="col">Year</th>
        <th scope="col">Crop</th>
        <th scope="col">Livelihood System</th>
        <th scope="col">Season</th>
        <th scope="col">Production period</th>
        <th scope="col">Production</th>
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
            <td>{{item.production_period}}</td>
            <td>{{item.production}}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    import {mapState} from 'vuex'

    export default {

        data() {
            return {
            }
        },

        mounted() {
            this.$store.dispatch('loadData');
        },

        computed: {
            ...mapState([
                'cropData'
            ])

        },


    }


</script>

