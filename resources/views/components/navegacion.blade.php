<nav class="navbar navbar-expand-lg navbar-light bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ url('/hclinicas') }}">
            <img src="{{ asset('assets/img/logo.png') }}" width="35px" height="auto" style="border-radius: 5px"
                alt="">
            <span class=""> Saúde Medical Group</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fa-solid fa-bars text-white"></i>
        </button>

        <nav class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

                @php
                    $user = Auth::user();
                @endphp

                @if ($user && $user->role === 'admin')
                    <a class="nav-link active text-white" href="{{ route('hclinicas.index') }}" aria-current="page">
                        <img class="svg-icon" src="{{ asset('assets/icons/hclinica.svg') }}" alt=""> Historias
                        Clínicas</a>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" href="{{ route('tratamientos.index') }}">
                            <img class="svg-icon" src="{{ asset('assets/icons/report.svg') }}"> Reportes</a>

                        <!-- Submenú -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('reportes.get_pacientes_por_odontologo')}}">Pacientes por odontólogo</a></li>
                            <li><a class="dropdown-item" href="{{route('reportes.get_pacientes_por_tratamiento')}}">Pacientes por tratamiento</a></li>
                            <li><a class="dropdown-item" href="{{route('reportes.total-presupuesto-por-meses')}}">Total de presupuestos</a></li>
                            <li><a class="dropdown-item" href="{{route('reportes.top_pacientes_por_presupuesto')}}">Top presupuestos</a></li>
                        </ul>
                    </li>


                    <a class="nav-link active text-white" href="{{ route('tratamientos.index') }}">
                        <img class="svg-icon" src="{{ asset('assets/icons/tratamiento.svg') }}"> Tratamientos</a>

                    <a class="nav-link active text-white" href="{{ route('especialidades.index') }}">
                        <img class="svg-icon" src="{{ asset('assets/icons/especialidad.svg') }}"> Especialidades</a>
                    {{-- <a class="nav-link active text-white" href="{{ route('odontologos.index') }}">
                        <img class="svg-icon" src="{{asset('assets/icons/odontologo.svg')}}"> Odontólogos
                    </a> --}}
                    <a class="nav-link text-white" href="{{ route('users.index') }}">
                        <img class="svg-icon" src="{{ asset('assets/icons/user.svg') }}" alt="">
                        {{ __('Usuarios') }}</a>

                    {{-- <a class="nav-link active text-white" href="{{ route('odontogramas.index') }}"> 
                        <img class="svg-icon" src="{{asset('assets/icons/diente.png')}}"> Odontogramas</a>
                    <a class="nav-link active text-white" href="{{ route('presupuestos.index') }}">
                        <img class="svg-icon" src="{{asset('assets/icons/presupuesto.svg')}}"> Presupuestos</a> --}}
                @endif

                @if ($user && $user->role === 'odontologo')
                    <a class="nav-link active text-white" href="{{ route('hclinicas.index') }}" aria-current="page">
                        <img class="svg-icon" src="{{ asset('assets/icons/hclinica.svg') }}" alt=""> Historias
                        Clínicas</a>
                    {{-- <a class="nav-link active text-white" href="{{ route('odontogramas.index') }}">
                        <img class="svg-icon" src="{{ asset('assets/icons/diente.png') }}"> Odontogramas</a>
                    <a class="nav-link active text-white" href="{{ route('presupuestos.index') }}">
                        <img class="svg-icon" src="{{ asset('assets/icons/presupuesto.svg') }}"> Presupuestos</a> --}}
                @endif

            </ul>

            <!-- Nav bar usuario no autenticado -->
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
        </nav>
    </div>
</nav>
