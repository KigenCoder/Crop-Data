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
            this.$store.dispatch('loadRegions')
        },

        computed: {
            ...mapState([
                'regions'
            ])

        },

        methods: {
            regionsSelected() {
                if (this.selectedRegions.length > 0) {
                    let districtFilter = this.selectedRegions.toString().replace('(', '')
                    districtFilter = districtFilter.replace(')', '')
                    let regionsClause = "r.id IN (" + this.selectedRegions.toString() + ")"
                    this.$store.commit("DISTRICTS_FILTER", districtFilter)
                    this.$store.commit('WHERE_REGIONS', regionsClause)
                } else {
                    this.$store.commit('WHERE_REGIONS', null)
                    this.$store.commit("DISTRICTS_FILTER",'')
                }

                this.$store.dispatch('loadFilteredData')
                this.$store.dispatch('loadDistricts')


            }
        }
    }
</script>