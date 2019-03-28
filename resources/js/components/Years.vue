<template>
    <ul>
        <li v-for="year in years">

            <input
                    type="checkbox"
                    v-bind:value="year.year"
                    v-model="selectedYears"
                    @change="yearsSelected()"
            >
            {{year.year}}
        </li>
    </ul>
</template>

<script>
    export default {
        data(){
            return {
                years: [],
                selectedYears: []
            }
        },

        methods: {
            yearsSelected() {
                if(this.selectedYears.length > 0) {
                    let yearsClause = "d.year IN (" + this.selectedYears.toString() + ")"
                    this.$store.commit('WHERE_YEARS', yearsClause)

                }else{
                    this.$store.commit('WHERE_YEARS', null)
                }

                this.$store.dispatch('loadFilteredData')

            }
        },

        created() {
            axios.get('./api/search_params').then(response=> this.years = response.data.years);
        }
    }
</script>