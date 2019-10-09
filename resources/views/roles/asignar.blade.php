@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Asignar rol a usuario</span>
                        <a href="/home" class="btn btn-primary btn-sm">Volver a la ventana principal.</a>
                    </div>
                    @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                    @endif
                    <div class="card-body">     
                      <form method="POST" action="">
                        @csrf
                        <label for="">Usuario:</label>
                        <select name="usuario" id="usuario">
                            @foreach ($usuarios as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <label for="">Rol:</label>
                        <select name="roles" id="roles">
                            @foreach ($roles as $rol)
                        <option value="{{$rol->id}}">{{$rol->nombre}}</option>
                            @endforeach
                        </select>
                              <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection