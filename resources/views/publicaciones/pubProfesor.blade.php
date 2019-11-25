@extends('layouts.app')

@section('content')

 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                    <div class="card">
                        <div class="card-header justify-content-between align-items-center">
                        <h5>{{$curso[0]->nombre}}</h5>
                        <a href="/vistageneral/{{$curso[0]->id}}" class="btn btn-primary btn-sm">Volver al curso {{$curso[0]->nombre}}</a>
                                <br>
                        </div>
            <div class="card-body">
                    <label for=""><h3>{{$publicacion->tema}}</h3></label>
                    <ul class="list-unstyled list-group list-group-flush">
                        <li class="media py-1">
                                <div class="media-body">
                                <p class="mt-0 mb-1">{!! $publicacion->descripcion !!}</p>
                                <a target="_blank" href="{{asset($archivo[0]->ruta)}}">{{$archivo[0]->nombre}}</a>
                                <br>
                                <a class="btn btn-light" href="/descargar/{{$archivo[0]->nombre}}">Descargar</a>
                                </div>
                            </li>
                          </ul>  
                        </div>
            </div>     
        </div>
    </div>
        </div>
@endsection
