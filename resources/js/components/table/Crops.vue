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
                if(this.selectedCrops.length > 0) {
                    let cropsClause = "d.crop_id IN (" + this.selectedCrops.toString() + ")"
                    this.$store.commit('tabular_data/WHERE_CROPS', cropsClause)

                }else{
                    this.$store.commit('tabular_data/WHERE_CROPS', null)
                }

                this.$store.dispatch('tabular_data/loadFilteredData')

            }
        },


        created() {
            axios.get('./api/search_params').then(response => this.crops = response.data.crops);
        },


    }
</script>