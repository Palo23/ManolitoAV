<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PerfilController extends Controller
{
    public function mostrarPerfil(int $id)
    {
        $user = User::find($id);

        return view('user.perfil')->with('user', $user);
    }
}
