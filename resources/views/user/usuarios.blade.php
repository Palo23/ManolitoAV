@extends('layouts.app')

@section('content')


                @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                @endif


    <div class="container">
        <a class="btn btn-info" href="{{ route('register')}}"><strong>Registrar Usuario</strong></a>
        <tabla-componente></tabla-componente>
    </div>
    
@endsection