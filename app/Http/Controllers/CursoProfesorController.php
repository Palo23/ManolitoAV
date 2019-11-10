<?php

namespace App\Http\Controllers;

use App\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CursoProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    private $profilePicturesFolder = "files";

    public function index()
    {
        $idUser = Auth::user()->id;

        return Cursos::where('id_user', $idUser)->with('archivo')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curso = new Cursos();

        $curso->id_user = Auth::user()->id;
        $curso->ID_Archivo = 2;
        $curso->nombre = $request->nombre;
        $curso->description = $request->descripcion;
        $curso->password = $request->password;

        $curso->save();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $curso = Cursos::find($id);
        $curso->nombre = $request->nombre;
        $curso->description = $request->descripcion;
        $curso->save();

        return $curso;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Cursos::findOrFail($id);
        $curso->users()->detach();
        $curso->delete();
    }
}
