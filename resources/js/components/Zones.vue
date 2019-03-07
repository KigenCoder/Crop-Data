<template>
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
            this.$store.dispatch('loadZones');
        },

        computed: {
            ...mapState([
                'zones'
            ])

        },


        methods: {
            zoneSelected() {
                if (this.selectedZones.length > 0) {
                    let zonesClause = "z.id IN (" + this.selectedZones.toString() + ")"
                    let regionFilter = this.selectedZones.toString().replace('(', '')
                    regionFilter = regionFilter.replace(')', '')

                    this.$store.commit('WHERE_ZONES', zonesClause)
                    this.$store.commit('REGION_FILTER', regionFilter)
                    //console.log("Zones: " + this.$store.getters.regionFilter)
                } else {
                    this.$store.commit('WHERE_ZONES', null)
                    this.$store.commit('REGION_FILTER', '')
                }
                this.$store.dispatch('loadFilteredData')
                this.$store.dispatch('loadRegions')
            },
        }


    }
</script>