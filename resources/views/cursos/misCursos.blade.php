@extends('layouts.app')

@section('content')
<div class="container">
        <div class="text-center">
                <a class="btn btn-outline-info" href="{{ route('todosCursos')}}"><strong>Todos los cursos</strong></a>
                <a class="btn btn-outline-info" href="{{ route('home')}}"><strong>Mis Cursos</strong></a>
            </div>
        
        <div class="container">
            <miscursos-componente></miscursos-componente>
        </div>
</div>




@endsection