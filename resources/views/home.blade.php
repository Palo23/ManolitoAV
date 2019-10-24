@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Opciones</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center">
                            <a class="btn btn-info" href="{{ route('register')}}"><strong>Registrar Usuario</strong></a>
                        </div>
                        <br>

                        

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
