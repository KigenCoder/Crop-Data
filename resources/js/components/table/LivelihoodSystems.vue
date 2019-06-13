<template>
    <ul>
        <li v-for="system in livelihood_systems">
            <input
                    type="checkbox"
                    v-bind:value="system.id"
                    v-model="selectedSystems"
                    @change="livelihoodSelected()"
            >
            {{system.livelihood_system}}
        </li>
    </ul>
</template>

<script>
    export default {
        data (){
            return {
                livelihood_systems: [],
                selectedSystems: []
            }
        },

        methods: {
            livelihoodSelected() {
                if(this.selectedSystems.length > 0) {
                    let livelihoodClause = "d.livelihood_system_id IN (" + this.selectedSystems.toString() + ")"
                    this.$store.commit('tabular_data/WHERE_LIVELIHOODS', livelihoodClause)

                }else{
                    this.$store.commit('tabular_data/WHERE_LIVELIHOODS', null)
                }

                this.$store.dispatch('tabular_data/loadFilteredData')

            }
        },


        created() {
            axios.get('./api/search_params').then(response => this.livelihood_systems = response.data.systems);
        },
    }
</script>

