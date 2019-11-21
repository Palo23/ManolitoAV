@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-0">
                
            <div class="container">
                <div class="card-header">
                        <h5>{{$curso->nombre}}</h5>
                        <a href="/home" class="btn btn-primary btn-sm">Volver a mis cursos</a>
                    <br>
                </div>
                @if ( session('mensaje') )
                    <div class="alert alert-danger">{{ session('mensaje') }}</div>
                @endif

                @if ( session('mensajePublicado') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                @endif

                    <label for=""><h3>Publicar</h3></label>
                    <form class="form-group" action="{{ route('subirArchivo') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div>
                            <label for="">Título:</label>
                            <input type="hidden" id="idCurso" name="idCurso" value="{{$curso->id}}">
                            <input class="form-control" type="text" name="titulo" id="titulo" placeholder="Título de la publicación" maxlength="50">
                            <label for="">Publicación:</label>
                            <textarea class="form-control" cols="50" rows="10" name="descripcion" id="descripcion" placeholder="Descripción"></textarea>
                            <label for="">Archivo:</label>
                            <input class="form-control" type="file" name="file-cur" accept=".jpg, .jpeg, .png, .doc, .docx, .pdf, .odt, .pptx, video/*"> 
                        </div>
                        <div class="py-2">
                            <button type="submit" class="btn btn-primary btn-lg">Publicar</button>
                        </div>
                    </form>
            </div>

            <div class="container">
                <label for=""><h3>Publicaciones</h3></label>
                    <div class="container">
                            <ul class="list-unstyled list-group list-group-flush">
                                @foreach ($publicaciones as $publicacion)
                                <li class="media py-1">
                                        <img width="45" height="25" src="../files/documentos.png" class="mr-3" alt="...">
                                        <div class="media-body">
                                          <a href="{{ route('vistaPub', [$publicacion->id]) }}"><h5 class="mt-0 mb-1">{{$publicacion->tema}}</h5></a>
                                          
                                        </div>
                                    </li>
                                @endforeach
                                  </ul>
                    </div>
            </div>
            
        </div>

        <div class="col-md-6 offset-0">

            <div class="card">
            <h5 class="card-header">Alumnos inscritos al curso {{$curso->nombre}}</h5>
                <div class="col-md-12 col-xs-12">
                    <div class="row" style="width: auto; margin: auto auto;">
                        <div class="col-md-4">
                    
                        @auth
                            @if (Auth::user()->id === $curso->id_user)
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Alumno</th>
                                    <th scope="col">Correo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($inscritos as $usuarios)
                                <tr>
                                    <th>
                                    <p>{{$usuarios->name}}</p>
                                    </th>
                                    <td>{{$usuarios->email}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>  
                            @endif
                        @endauth
                    </div>   
                    <div class="col-md-7">
                        <p>
                        </p>
                        <br>
                    </div>
                    </div>
                </div>
              </div>
        </div>

    </div>
</div>
@endsection
