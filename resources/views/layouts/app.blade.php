<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Historias Clínicas Odontológicas</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('assets/css/estilos.css') }}" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

</head>
<body>
    <div id="app">

        <!-- Navegación -->
        <x-navegacion></x-navegacion>

        <main class="container">
            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <!--Alerts-->
                    <x-flash_alerts></x-flash_alerts>
                    @yield('content') 
                    {{-- {{ $slot }} --}}
                </div>
                <div class="col-md-1"></div>
            </div>
        </main>
    </div>
</body>
</html>
