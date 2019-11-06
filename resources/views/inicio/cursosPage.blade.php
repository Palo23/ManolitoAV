@extends('layouts.app')

@section('content')

<?php 
use App\Archivos;
?>

<div class="container">

  <div class="row">
  @foreach ($cursos as $curso)
  
  <?php
    

    $archivo = $curso->ID_archivo;
    $foto = Archivos::find($archivo);

  ?>

    <div class="col-sm-6 py-2">
      <div class="card">
          <img width="50" height="100" src="{{$foto->ruta}}" class="card-img-top" alt="...">
        <div class="card-body">
        <h5 class="card-title">{{$curso->nombre}}</h5>
          <p class="card-text">{{$curso->description}}</p>
          <form action="{{ route('inscribirse') }}" method="POST">
            <div class="form-group">
            <input type="hidden" name="id" id="id" value="{{$curso->id}}">
                <label for="password">Contraseña:</label>
                <input id="password" type="password" class="form-control" name="password">
            </div>
            <button class="btn btn-primary" type="submit">Inscribirse</button>
        </form>
        </div>
      </div>
    </div>
  
  @endforeach
</div>
<br>

</div>

@endsection
