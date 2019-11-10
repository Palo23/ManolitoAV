<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    public function archivo()
    {
        return $this
        ->belongsTo('App\Archivos', 'ID_archivo');
    }

    public function users()
    {
        return $this
        ->belongsToMany('App\User')
        ->withTimestamps();
    }

    public function profesor()
    {
        return $this
        ->belongsTo('App\User', 'id_user');
    }
}
