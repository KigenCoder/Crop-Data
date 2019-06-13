@extends("templates.app")


@section("content")
    <div id="app">
        <div class="tile is-ancestor">
            <div class="tile is-parent is-vertical is-10 ">
                <div class="table-scroll">
                    <crops-table></crops-table>
                </div>

            </div>


            <div class="tile is-parent">
                <div class="tile is-ancestor">
                    <div class="tile is-vertical" style="margin-top: 10px;">
                        <!-- Zones Filter -->
                        <div>
                            <p class="align-center">
                                <strong>ZONES</strong>
                            </p>
                            <div class="filter-scroll">
                                <zones></zones>
                            </div>
                        </div>

                        <!-- Regions Filter -->
                        <div>
                            <p class="align-center">
                                <strong>REGIONS</strong>
                            </p>
                            <div class="filter-scroll">
                                <regions></regions>
                            </div>
                        </div>

                        <!-- Districts Filter -->
                        <div>
                            <p class="align-center">
                                <strong>DISTRICTS</strong>
                            </p>
                            <div class="filter-scroll">
                                <districts></districts>
                            </div>
                        </div>

                        <!-- Years Filter -->
                        <div>
                            <p class="align-center">
                                <strong>YEAR</strong>
                            </p>
                            <div class="filter-scroll">
                                <years></years>
                            </div>
                        </div>

                        <!-- Seasons Filter -->
                        <div>
                            <p class="align-center">
                                <strong>Seasons</strong>
                            </p>
                            <div class="filter-scroll">
                                <seasons></seasons>
                            </div>
                        </div>

                        <!-- Crops -->
                        <div>
                            <p class="align-center">
                                <strong>CROPS</strong>
                            </p>
                            <div class="filter-scroll">
                                <crops></crops>
                            </div>
                        </div>


                        <!-- Livelihood Systems Filter -->
                        <div>
                            <p class="align-center">
                                <strong>LIVELIHOOD SYSTEMS</strong>
                            </p>
                            <div class="filter-scroll">
                                <livelihood_systems></livelihood_systems>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
@stop

