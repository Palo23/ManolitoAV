<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
    public function curso()
    {
        return $this->belongsToMany('App\Cursos')
        ->withTimestamps();
    }

    public function publica()
    {
        return $this->belongsToMany('App\Publicaciones')
        ->withTimestamps();
    }

    public function hasPublicacion($publicacion)
    {
    if ($this->publica()->where('publicacion_id', $publicacion)->first()) {
        return true;
    }
    return false;
    }
}
