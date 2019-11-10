<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cursos;
use Illuminate\Support\Facades\Auth;
use App\Archivos;
use App\Http\Requests\UpdateFotoPerfil;
use App\User;
use Illuminate\Support\Str;

class EditarCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       // $this->middleware('guest');
        $this->middleware('auth');
    }

    private $profilePicturesFolder = "files";

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuarioID = Auth::user()->id;
        $usuario = User::find($usuarioID);
        $curso = Cursos::where('id', $id)->with('users')->first();
        $inscritos = $curso->users;
        $cursoID = $curso->id_user;
        if ($usuarioID === $cursoID) {
            $archivo = $curso->ID_archivo;
            $foto = Archivos::find($archivo);
            return view('cursos.editarCurso', compact('curso', 'foto', 'usuario', 'inscritos'));
        }else {
            return back();
        }
        
    }

    public function actualizarFotoCurso(UpdateFotoPerfil $request, $id) 
    {
        $archivo = $request->file('profile-picture');
        $nombreArchivo = Str::random(10) . '.' .$archivo->getClientOriginalExtension();
        
        $foto = new Archivos;
        $foto->ruta = "/files" . '/' . $nombreArchivo;
        $foto->nombre = $nombreArchivo;
        $foto->save();
        $curso = Cursos::find($id);
        $curso->nombre = $request->nombre;
        $curso->description = $request->descripcion;
        $archivo->move($this->profilePicturesFolder,$nombreArchivo);// subimos al servidor
        $curso->ID_archivo = $foto->id; // guardamos el nombre en la bd
        $curso->save(); // guardamos los cambios.

        return redirect()->route('edicion', ['id' => $curso->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
