<?php

namespace App\Http\Controllers;

use App\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Archivos;
use App\Publicaciones;
use App\Http\Requests\UploadFile;
use Illuminate\Support\Str;

class GeneralController extends Controller
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
        $cursos = Cursos::find($id);
        $idUser = Auth::user()->id;
        $profesorCurso = $cursos->id_user;

        if ((Auth::user()->hasCurso($id)) || ($idUser === $profesorCurso) ) {
            if (Auth::user()->hasRole("Alumno")) {
                $curso = Cursos::where('id', $id)->with('publicaciones')->first();
                $publicaciones = $curso->publicaciones;
                $cursoID = $curso->id;
                if (Auth::user()->hasCurso($cursoID)) {
                    return view('cursos.vistaGeneral', compact('curso', 'publicaciones'));
                } else {
                    return back();
                }
            }elseif (Auth::user()->hasRole("Profesor")) {
                $usuarioID = Auth::user()->id;
                $usuario = User::find($usuarioID);
                $curso = Cursos::where('id', $id)->with('users', 'publicaciones')->first();
                $publicaciones = $cursos->publicaciones;
                $inscritos = $curso->users;
                $cursoID = $curso->id_user;
                    if ($usuarioID === $cursoID) {
                        $archivo = $curso->ID_archivo;
                        $foto = Archivos::find($archivo);
                        return view('cursos.vistaProfesor', compact('curso', 'foto', 'usuario', 'inscritos', 'publicaciones'));
                    }else {
                        return back();
                    }
            }
            
            }else{
                return back();
            }
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

    public function subirArchivo(Request $request) 
    {
        if ($request->titulo === NULL) {
            return back()->with('mensaje', 'Debes agregar un tema');
        }else if ($request->hasFile('file-cur')) {
            $archivo = $request->file('file-cur');
        $nombreArchivo = $archivo->getClientOriginalName();
        
        $foto = new Archivos;
        $foto->ruta = "/files" . '/' . $nombreArchivo;
        $foto->nombre = $nombreArchivo;
        $foto->save();
        $cursoID = $request->idCurso;
        $archivo->move($this->profilePicturesFolder,$nombreArchivo);// subimos al servidor
        $publicacion = new Publicaciones;
        $publicacion->tema = $request->titulo;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->save();

        $publicacion->miCurso()->attach($cursoID);
        $publicacion->archivosPub()->attach($foto->id);
        
        return redirect()->route('vistaCurso', ['id' => $cursoID]);
        }else{
            $cursoID = $request->idCurso;
            $publicacion = new Publicaciones;
            $publicacion->tema = $request->titulo;
            $publicacion->descripcion = $request->descripcion;
            $publicacion->save();

            $publicacion->miCurso()->attach($cursoID);
            return redirect()->route('vistaCurso', ['id' => $cursoID]);
        }
        
    }

    public function mostrarPublicacion($id){
        

        $publicacion = Publicaciones::where('id', $id)->with('miCurso', 'archivosPub')->first();
        $idPublicacion = $id;
        $archivo = $publicacion->archivosPub;
        $curso = $publicacion->miCurso;

        $idCurso = $curso[0]->id_user;

        if (Auth::user()->id === $idCurso) {
            if ($archivo->isEmpty()) {
                return view('publicaciones.pubNoFile', compact('publicacion', 'curso'));
            } else {
                return view('publicaciones.pubProfesor', compact('publicacion', 'archivo', 'curso'));
            }
        }else{
            return back();
        }

    }

    public function descargarArchivo($archivo){
        $pathtoFile = public_path().'/files/'.$archivo;
        return response()->download($pathtoFile);
    }

    public function mostrarPublicacionAlumno($id){
        $publicacion = Publicaciones::where('id', $id)->with('miCurso', 'archivosPub')->first();
        $archivo = $publicacion->archivosPub;
        $curso = $publicacion->miCurso;

        $idCurso = $curso[0]->id;

        if (Auth::user()->hasCurso($idCurso)) {
            if ($archivo->isEmpty()) {
                return view('publicaciones.pubNoFile', compact('publicacion', 'curso'));
            } else {
                return view('publicaciones.pubProfesor', compact('publicacion', 'archivo', 'curso'));
            }
        }else{
            return back();
        }
    }

}
