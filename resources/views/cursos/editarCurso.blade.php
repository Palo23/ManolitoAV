@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-0">

            <div class="card">
            <h5 class="card-header">Curso {{$curso->nombre}}</h5>
                <div class="col-md-12 col-xs-12">
                    <div class="row" style="width: auto; margin: auto auto;">
                        <div class="col-md-4">
                            <img src="{{ $foto->ruta }}" class="img-thumbnail" />
                    
                        @auth
                            @if (Auth::user()->id === $curso->id_user)
                                <form action="{{ route('actualizarFotoCurso', ['id' => $curso->id]) }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div style="overflow-x: hidden;border: 1px solid #f1f1f1; margin: 5px 0px 3px 0px;">
                                        <input type="file" name="profile-picture" accept=".jpg, .jpeg, .png" class="btn btn-xs">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-xs">Actualizar</button>
                                    </div>
                                </div>
                                <div id="midiv" class="col-md-7">
                                    <p>
                                        <h1><strong><span class="mispan">{{ $curso->nombre }}</span></strong></h1>
                                        <h4><span class="mispan2">{{ $curso->description }}</span></h5>
                                        <h3><small>Profesor: {{ $usuario->name }}</small></h3>
                                    </p>
                                    <br>
                                </div>

                                    @if ($errors->has('profile-picture'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('profile-picture') }}
                                        </div>
                                    @endif
                                </form>
                            @endif
                        @endauth
                      
                    </div>
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
