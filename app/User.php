<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function cursos()
    {
        return $this
        ->belongsToMany('App\Cursos')
        ->withTimestamps();
    }

    public function hasCurso($curso)
{
    if ($this->cursos()->where('cursos_id', $curso)->first()) {
        return true;
    }
    return false;
}

    public function roles()
    {
        return $this
            ->belongsToMany('App\Roles')
            ->withTimestamps();
    }

    public function authorizeRoles($roles)
{
    if ($this->hasAnyRole($roles)) {
        return true;
    }
    abort(401, 'Esta acción no está autorizada.');
}public function hasAnyRole($roles)
{
    if (is_array($roles)) {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
    } else {
        if ($this->hasRole($roles)) {
            return true;
        }
    }
    return false;
}public function hasRole($role)
{
    if ($this->roles()->where('nombre', $role)->first()) {
        return true;
    }
    return false;
}

    protected $fillable = [
        'name', 'email', 'password', 'ID_archivo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    

}