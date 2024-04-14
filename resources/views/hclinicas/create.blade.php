@extends('layouts.app')
@section('content')
    <form action="{{ route('hclinicas.store') }}" method="POST">
        @csrf
        
    </form>

@endsection
