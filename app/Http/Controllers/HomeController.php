<?php


namespace App\Http\Controllers;

use App\Roles;
use App\Cursos;
use App\Archivos;
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
            return view('user.usuarios');
        } else if(Auth::user()->hasRole('Profesor')) {
            return view('inicio.agregarCurso');
        }else if(Auth::user()->hasRole('Alumno')) {
            $cursos = Cursos::all();
            return view('cursos.misCursos');
        }
     //  return view('home');
    }

    public function usuario(){
        return view('user.usuarios');
    }

    public function inscribirse(Request $request){
        //$idUsuario = Auth::user()->id;
        //$id = $request->id;
        //$usuario = User::find($idUsuario);
        //$curso = Cursos::find($id);
        //$curso->users()->attach($idUsuario);
        return view('cursos.vistaGeneral', compact('$curso'));
    }

    public function todosCursos(){
        if(Auth::user()->hasRole('Alumno')) {
            $cursos = Cursos::all();
            return view('inicio.inscripcion');
        }
    }

    public function search(Request $request)
    {
    $posts = User::where('name', 'LIKE', '%'.$request->search.'%')->get();
    return \response()->json($posts);
    }

}
