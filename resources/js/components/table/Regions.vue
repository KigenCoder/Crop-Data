<template>
    <ul>
        <li v-for="region in regions">
            <input
                    type="checkbox"
                    v-bind:value="region.id"
                    v-model="selectedRegions"
                    @change="regionsSelected()"
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
                selectedRegions: []
            }
        },

        mounted(){
            this.$store.dispatch('tabular_data/loadRegions')
        },

        computed: {
            ...mapState('tabular_data', [
                'regions'
            ])

        },

        methods: {
            regionsSelected() {
                if (this.selectedRegions.length > 0) {
                    let districtFilter = this.selectedRegions.toString().replace('(', '')
                    districtFilter = districtFilter.replace(')', '')
                    let regionsClause = "r.id IN (" + this.selectedRegions.toString() + ")"
                    this.$store.commit("tabular_data/DISTRICTS_FILTER", districtFilter)
                    this.$store.commit('tabular_data/WHERE_REGIONS', regionsClause)
                } else {
                    this.$store.commit('tabular_data/WHERE_REGIONS', null)
                    this.$store.commit("tabular_data/DISTRICTS_FILTER",'')
                }

                this.$store.dispatch('tabular_data/loadFilteredData')
                this.$store.dispatch('tabular_data/loadDistricts')


            }
        }
    }
</script>