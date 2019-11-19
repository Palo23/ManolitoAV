<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicaciones extends Model
{
    public function archivosPub()
    {
        return $this->belongsToMany('App\Archivos')
        ->withTimestamps();
    }

    public function miCurso()
    {
        return $this->belongsToMany('App\Cursos')
        ->withTimestamps();
    }

    public function comentario()
    {
        return $this->belongsToMany('App\Comentarios')
        ->withTimestamps();
    }
}
