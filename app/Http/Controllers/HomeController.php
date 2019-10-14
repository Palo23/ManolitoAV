<?php


namespace App\Http\Controllers;

use App\Roles;
use \Auth;
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
        if (Auth::user()->hasRole('Administrador')) {
            return view('home', compact('roles'));
        } else if(Auth::user()->hasRole('Profesor')) {
            return view('inicio.agregarCurso');
        }else if(Auth::user()->hasRole('Alumno')) {
            return view('inicio.cursosPage');
        }
     //  return view('home');

    }
}
