@extends('layouts.app')

@section('content')

 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                    <div class="card">
                        <div class="card-header justify-content-between align-items-center">
                        <h5>{{$curso->nombre}}</h5>
                        <a href="/home" class="btn btn-primary btn-sm">Volver a mis cursos</a>
                        </div>
            <div class="card-body">
                    <label for=""><h3>Todas las publicaciones:</h3></label>
                    <ul class="list-unstyled list-group list-group-flush">
                        @foreach ($publicaciones as $publicacion)
                        <li class="media py-1">
                            <img width="45" height="25" src="../files/documentos.png" class="mr-3" alt="...">
                                <div class="media-body">
                                  <a href="{{ route('vistaPubAlumno', [$publicacion->id]) }}"><h5 class="mt-0 mb-1">{{$publicacion->tema}}</h5></a>
                                  <p>{{$publicacion->updated_at}}</p>
                                </div>
                            </li>
                        @endforeach
                          </ul>
                        </div>
            </div>     
        </div>
    </div>
        </div>
@endsection
