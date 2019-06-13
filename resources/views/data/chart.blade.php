@extends("templates.app")

@section("content")
    <div id="app">
        <div class="tile is-ancestor container" style="margin-top: 10px">
            <div class="tile is-parent is-3" >
                <div class="tile is-child is-vertical box ">
                    <!-- Regions Filter -->
                    <div>
                        <p class="align-center">
                            <strong>REGIONS</strong>
                        </p>
                        <div class="filter-scroll">
                            <chart-regions></chart-regions>
                        </div>
                    </div>

                    <!-- Districts Filter -->
                    <div>
                        <p class="align-center">
                            <strong>DISTRICTS</strong>
                        </p>
                        <div class="filter-scroll">
                            <chart-districts></chart-districts>
                        </div>
                    </div>


                    <!-- Crops -->
                    <div>
                        <p class="align-center">
                            <strong>CROPS</strong>
                        </p>
                        <div class="filter-scroll">
                            <chart-crops></chart-crops>
                        </div>
                    </div>

                    <!-- Seasons Filter -->
                    <div>
                        <p class="align-center">
                            <strong>Seasons</strong>
                        </p>
                        <div class="filter-scroll">
                            <chart-seasons></chart-seasons>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tile is-parent box container">
                <div class="tile is-child">
                    <!-- Chart -->
                    <chart-data></chart-data>
                </div>
            </div>

        </div>
    </div>
@stop
