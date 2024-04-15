@extends('layouts.app')
@section('content')
    <h2 class="text-center fw-bold"> <img src="assets/icons/historia.png"> Pacientes</h2>

    <!--Input para buscar una historia-->
    <form action="{{ route('pacientes.index') }}" method="GET">
        @csrf
        @method('GET')

        <div class="row">
            <div class="input-group mb-3">
                <div class="col-9 col-md-7 col-lg-5">
                    <input type="text" class="form-control" name="buscador"
                        placeholder="Buscar por nro. de idetificación, nombres o apellidos" value= "{{ $search }}"
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-secondary" type="submit" id="button-addon2"><i
                            class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                </div>
            </div>
        </div>
    </form>

    <a href="{{ route('pacientes.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Nuevo paciente</a>


    <div class="table-responsive">
        <br>
        <table class="table">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col" class="col-md-1">Nº</th>
                    <th scope="col" class="col-md-2">Nro Identificación</th>
                    <th scope="col" class="col-md-3">Paciente</th>
                    <th scope="col" class="col-md-1">Edad</th>
                    <th scope="col" class="col-md-2">Celular</th>
                    <th scope="col" class="col-md-3">Historia clínica</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pacientes as $paciente)
                    <tr class="">
                        <td scope="row">{{ $paciente->id }}</td>
                        <td>{{ $paciente->num_identificacion }}</td>
                        <td>{{ $paciente->apellidos . ' ' . $paciente->nombres }}</td>
                        <td>{{ $paciente->edad }} años</td>
                        <td>{{ $paciente->celular }}</td>
                        <td>
                            <!--editar-->
                            <a href="{{ route('hclinicas.show', $paciente->id) }}" class="btn btn-secondary"><i
                                    class="fa-regular fa-pen-to-square"></i> Ver</a>
                        </td>
                    </tr>
                    @include('hclinicas.destroy')
                @empty
                    <tr>
                        <td colspan="6">No hay resultados</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <!--Paginacion-->
        {{ $pacientes->links() }}
    </div>
@endsection
