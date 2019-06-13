<template>
    <div>
        <ul>
            <li v-for="zone in zones">
                <input
                    type="checkbox"
                    v-bind:value="zone.id"
                    v-model="selectedZones"
                    @change="zoneSelected($event)"
                >
                {{zone.zone}}
            </li>
        </ul>
    </div>

</template>
<script>
    import {mapState} from 'vuex'

    export default {
        data() {
            return {
                //zones: [],
                selectedZones: [],
            }
        },

        mounted() {
            this.$store.dispatch('tabular_data/loadZones');
        },



        computed: {
            ...mapState('tabular_data', [
                'zones'
            ])

        },


        methods: {
            zoneSelected() {
                if (this.selectedZones.length > 0) {
                    let zonesClause = "z.id IN (" + this.selectedZones.toString() + ")"
                    let regionFilter = this.selectedZones.toString().replace('(', '')
                    regionFilter = regionFilter.replace(')', '')

                    this.$store.commit('tabular_data/WHERE_ZONES', zonesClause)
                    this.$store.commit('tabular_data/REGION_FILTER', regionFilter)
                    //console.log("Zones: " + this.$store.getters.regionFilter)
                } else {
                    this.$store.commit('tabular_data/WHERE_ZONES', null)
                    this.$store.commit('tabular_data/REGION_FILTER', '')
                }
                this.$store.dispatch('tabular_data/loadFilteredData')
                this.$store.dispatch('tabular_data/loadRegions')
            },
        }


    }
</script>
