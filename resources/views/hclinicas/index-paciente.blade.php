@extends('layouts.app')
@section('content')

    @php
        $contentPaciente = '<div class="d-lg-flex justify-content-evenly">
                                <p><strong>CI:</strong> ' . $paciente->cedula .'</p>
                                <p><strong>EDAD:</strong> ' . $paciente->edad . " años" .'</p>
                            </div>';
    @endphp

    <div class="d-md-flex justify-content-around">
        <x-card :title="'PACIENTE: ' . $paciente->nombres . ' ' .  $paciente->apellidos" :content="$contentPaciente"/>
        <x-card title="ENFERMEDADES: " :content="$antecendentes->enfermedades"/>
        <x-card title="MEDICAMENTOS: " :content="$antecendentes->medicamento"/>
    </div>
    
    <x-navegacion-paciente/>
    @yield('content-paciente')
@endsection


