@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="col-md-12  col-xs-12">
                        <div class="row">

                            <div class="col-md-3">
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
                                    <h1>{{ $user->name }}</h1>
                                    @auth
                                        @if (Auth::user()->id == $user->id)
                                            <a href="{{ route('perfil.editar') }}" class="btn btn-primary">Editar perfil</a>
                                        @endif
                                    @endauth
                                </p>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts') 
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                photo: null,
                description: null,
            },
            methods: {
                openModal: function(e) {
                    this.photo = e.target.getAttribute('photo')
                    this.description = e.target.getAttribute('description')
                    $('#post_modal').modal()
                }
            }
        });
    </script>
@endsection