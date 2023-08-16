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
        <nav class="navbar navbar-expand-lg navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/hclinicas') }}">
                    <img src="{{asset('assets/img/logo.png')}}" width="35px" height="auto" style="border-radius: 5px" alt="">
                    <span class=""> Saúde Medical Group</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fa-solid fa-bars text-white"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                        @php
                            $user = Auth::user();
                        @endphp

                        @if ($user && $user->role === 'admin')
                            <a class="nav-link active text-white" href="{{ route('hclinicas.index') }}" aria-current="page"> 
                             <img class="svg-icon" src="{{asset('assets/icons/historia.png')}}" alt=""> Historias Clínicas</a>
                            <a class="nav-link active text-white" href="{{ route('odontogramas.index') }}"> 
                                <img class="svg-icon" src="{{asset('assets/icons/diente.png')}}"> Odontogramas</a>
                            <a class="nav-link active text-white" href="{{ route('presupuestos.index') }}">
                                <img class="svg-icon" src="{{asset('assets/icons/presupuesto.svg')}}"> Presupuestos</a>
                            <a class="nav-link active text-white" href="{{ route('tratamientos.index') }}">
                                <img class="svg-icon" src="{{asset('assets/icons/tratamiento.svg')}}"> Tratamientos</a>
                            <a class="nav-link active text-white" href="{{ route('especialidades.index') }}">
                                <img class="svg-icon" src="{{asset('assets/icons/especialidad.svg')}}"> Especialidades</a>
                            <a class="nav-link active text-white" href="{{ route('odontologos.index') }}">
                                <img class="svg-icon" src="{{asset('assets/icons/odontologo.svg')}}"> Odontólogos</a>
                            <a class="nav-link text-white" href="{{ route('users.index') }}">
                                <img class="svg-icon" src="{{asset('assets/icons/user.svg')}}" alt=""> {{ __('Usuarios') }}</a>
                        @endif

                        @if ($user && $user->role === 'odontologo')
                        <a class="nav-link active text-white" href="{{ route('hclinicas.index') }}" aria-current="page"> 
                            <img class="svg-icon" src="{{asset('assets/icons/historia.png')}}" alt=""> Historias Clínicas</a>
                           <a class="nav-link active text-white" href="{{ route('odontogramas.index') }}"> 
                               <img class="svg-icon" src="{{asset('assets/icons/diente.png')}}"> Odontogramas</a>
                           <a class="nav-link active text-white" href="{{ route('presupuestos.index') }}">
                               <img class="svg-icon" src="{{asset('assets/icons/presupuesto.svg')}}"> Presupuestos</a>
                        @endif
                  
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Inicio de Sesión') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container">
            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    @include('components.flash_alerts')
                    @yield('content')
                </div>
                <div class="col-md-1"></div>
            </div>
        </main>
    </div>
</body>
</html>
