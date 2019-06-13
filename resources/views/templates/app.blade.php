<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FSNAU CROP DATA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'} </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.css" type="text/css">
    <link href="{{asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="tile is-ancestor container is-vertical">
        <div class="tile  is-parent">
            <section class="hero is-primary is-small">
                <div class="hero-body">
                    <div class="navbar-brand">
                        <img src="../../images/fsnau_logo.png" alt="FSNAU">
                        <div class="container" style="margin-top: 20px; margin-left: 20px;">
                            <p class="title">
                                CROP PRODUCTION DATA
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-link" href="{{action('CropData@index')}}">
                                <strong>TABLE</strong>
                            </a>
                            <a class="button is-link" href="{{action('CropData@chart')}}">
                                CHART
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="tile is-parent">
            @yield('content')
        </div>


    </div>


</div>
</body>

<!-- javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!--<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script> -->

<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


<!-- Vue Javascript file -->
<script src="{{asset('js/app.js')}}"></script>

</html>
