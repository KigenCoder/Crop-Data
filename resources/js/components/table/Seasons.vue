<template>

    <ul>
        <li v-for="season in seasons">
            <input
                type="checkbox"
                v-bind:value="season.id"
                v-model="selectedSeasons"
                @change="seasonSelected()"
            >
            {{season.season}}
        </li>
    </ul>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        data() {
            return {
                selectedSeasons: []
            }
        },

        mounted() {
            this.$store.dispatch('tabular_data/loadSeasons')
        },

        computed: {
            ...mapState('tabular_data', [
                'seasons'
            ])

        },

        methods: {
            seasonSelected() {

                if (this.selectedSeasons.length > 0) {
                    let seasonsClause = "d.season_id IN (" + this.selectedSeasons.toString() + ")"
                    this.$store.commit('tabular_data/WHERE_SEASONS', seasonsClause)

                } else {
                    this.$store.commit('tabular_data/WHERE_SEASONS', null)
                }
                this.$store.dispatch('tabular_data/loadFilteredData');

            }
        }
    }
</script>

