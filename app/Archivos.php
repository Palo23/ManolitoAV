<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
    public function curso()
    {
        return $this->hasMany('App\Cursos');
    }
}
