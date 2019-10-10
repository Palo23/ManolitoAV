<?php

namespace App\Http\Controllers;

use App\Roles;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $idUsuario = auth()->user()->ID_rol;
        $rol = Roles::where('ID_rol', $idUsuario)->first();
        $nombreRol = $rol->nombre;
        if ($nombreRol === 'Administrador') {
            $roles = Roles::all();
            return view('home', compact('roles'));
        } else if($nombreRol === 'Profesor') {
            return view('inicio.agregarCurso');
        }else if($nombreRol === 'Alumno') {
            return view('inicio.cursosPage');
        }
    }
}
