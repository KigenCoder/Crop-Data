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
        name: 'Seasons',
        data() {
            return {
                selectedSeasons: []
            }
        },

        mounted() {
            this.$store.dispatch('loadSeasons')
        },

        computed: {
            ...mapState([
                'seasons'
            ])

        },

        methods: {
            seasonSelected() {

                if (this.selectedSeasons.length > 0) {
                    let seasonsClause = "d.season_id IN (" + this.selectedSeasons.toString() + ")"
                    this.$store.commit('WHERE_SEASONS', seasonsClause)

                } else {
                    this.$store.commit('WHERE_SEASONS', null)
                }
                this.$store.dispatch('loadFilteredData');

            }
        }
    }
</script>

