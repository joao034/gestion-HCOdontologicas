@extends('layouts.app')
@section('content')
<a href="{{ route('hclinicas.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Nueva historia clínica</a>

<div class="table-responsive">
    <br>
    <table class="table">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col" class="">Nº</th>
                <th scope="col" class="">Fecha de creación</th>
                <th scope="col" class="">Paciente</th>
                <th scope="col" class="">Odontólogo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hClinicas as $hClinica)
                <tr class="">
                    <td scope="row">{{ $hClinica->id }}</td>
                    <td>{{ $hClinica->created_at->format('d/m/y') }}</td>
                    <td>{{ $hClinica->paciente->nombreCompleto() }}</td>
                    <td>{{ $hClinica->odontologo_id}} </td>
                    <td>
                        <!--editar-->
                        <a href="{{ route('consultas.edit', $hClinica->id) }}" class="btn btn-secondary"><i
                                class="fa-regular fa-pen-to-square"></i> Ver</a>
                        <!--eliminar-->
                        {{-- <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$paciente->id}}">
                    <i class="fa-regular fa-trash-can"></i> Eliminar
                </a> --}}
                    </td>
                </tr>
                {{-- @include('hclinicas.destroy') --}}
            @empty
                <tr>
                    <td colspan="6">El paciente no tiene historias clinicas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
