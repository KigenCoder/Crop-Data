<template>
    <ul>
        <li v-for="crop in crops">
            <input
                    type="radio"
                    v-bind:value="crop.id"
                    v-model="selectedCrop"
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
                selectedCrop: '',
            }
        },

        methods: {
            cropsSelected() {
                //Reset current data
                this.$store.commit('chart_data/mutateChartData', [])

                //Save selected crop
                this.$store.commit('chart_data/mutateCropId', this.selectedCrop)

                //check if region/district is set, then fetch data
                let districtId = this.$store.getters['chart_data/getDistrictId']
                let regionId = this.$store.getters['chart_data/getRegionId']

                if(districtId || regionId){
                    this.$store.dispatch('chart_data/loadChartData')
                }

            }
        },


        created() {
            axios.get('./api/search_params').then(response => this.crops = response.data.crops);
        },


    }
</script>