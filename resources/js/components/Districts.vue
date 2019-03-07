<template>
    <ul>
        <li v-for="district in districts">
            <input
                    type="checkbox"
                    v-bind:value="district.id"
                    v-model="selectedDistricts"
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
                selectedDistricts: []
            }
        },

        mounted(){
           //this.$store.dispatch('loadDistricts')
        },

        computed : {
             ...mapState([
                 'districts'
             ])
        },

        methods: {
            districtsSelected() {
                if(this.selectedDistricts.length > 0) {
                    let districtsClause = "d.district_id IN (" + this.selectedDistricts.toString() + ")"
                    this.$store.commit('WHERE_DISTRICTS', districtsClause)

                }else{
                    this.$store.commit('WHERE_DISTRICTS', null)
                }

                this.$store.dispatch('loadFilteredData')




            }

        }
    }
</script>