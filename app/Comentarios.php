<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    public function publicaCom()
    {
        return $this->belongsToMany('App\Comentarios')
        ->withTimestamps();
    }
}
