@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">

            <div class="card">
                <h5 class="card-header">Tu perfil</h5>
                <div class="col-md-12 col-xs-12">
                    <div class="row" style="width: auto; margin: auto auto;">
                        <div class="col-md-4">
                            <img src="{{ $foto->ruta }}" class="img-thumbnail" />
                    
                        @auth
                            @if (Auth::user()->id === $user->id)
                                <form action="{{ route('actualizarFoto') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div style="overflow-x: hidden;border: 1px solid #f1f1f1; margin: 5px 0px 3px 0px;">
                                        <input type="file" name="profile-picture" class="btn btn-xs">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-xs">Actualizar</button>
                                    
                                    @if ($errors->has('profile-picture'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('profile-picture') }}
                                        </div>
                                    @endif
                                </form>
                            @endif
                        @endauth
                    </div>   
                    <div class="col-md-7">
                        <p>
                            <h1><strong>{{ $user->name }}</strong></h1>
                            <h3><small>{{ $user->email }}</small></h3>
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