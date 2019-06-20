@extends("templates.app")


@section("content")
    <div id="app">
        <div class="tile is-ancestor container">
            <div class="tile  is-parent is-vertical is-9">
                <crops-table></crops-table>
            </div>


            <div class="tile is-parent box is-vertical panel-background small-font is-size-7">
                <!-- Zones Filter -->
                <div class="box panel-background">
                    <p class="align-center">
                        <strong>ZONES</strong>
                    </p>
                    <div class="filter-scroll">
                        <zones></zones>
                    </div>
                </div>

                <!-- Regions Filter -->
                <div class="box panel-background">
                    <p class="align-center">
                        <strong>REGIONS</strong>
                    </p>
                    <div class="filter-scroll">
                        <regions></regions>
                    </div>
                </div>

                <!-- Districts Filter -->
                <div class="box panel-background">
                    <p class="align-center">
                        <strong>DISTRICTS</strong>
                    </p>
                    <div class="filter-scroll">
                        <districts></districts>
                    </div>
                </div>

                <!-- Years Filter -->
                <div class="box panel-background">
                    <p class="align-center">
                        <strong>YEAR</strong>
                    </p>
                    <div class="filter-scroll">
                        <years></years>
                    </div>
                </div>

                <!-- Seasons Filter -->
                <div class="box panel-background">
                    <p class="align-center">
                        <strong>Seasons</strong>
                    </p>
                    <div class="filter-scroll">
                        <seasons></seasons>
                    </div>
                </div>

                <!-- Crops -->
                <div class="box panel-background">
                    <p class="align-center">
                        <strong>CROPS</strong>
                    </p>
                    <div class="filter-scroll">
                        <crops></crops>
                    </div>
                </div>


                <!-- Livelihood Systems Filter -->
                <div class="box panel-background">
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
@stop

