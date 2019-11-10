@extends('layouts.app')

@section('content')


                @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                @endif


    <div class="container">

            <div class="text-center">
                    <a class="btn btn-outline-info" href="{{ route('register')}}"><strong>Registrar Usuario</strong></a>
                    <a class="btn btn-outline-info" href="{{ route('usuario.tabla')}}"><strong>Gestionar Usuarios</strong></a>
            </div>
            <br>

        <tabla-componente></tabla-componente>
    </div>
    
@endsection