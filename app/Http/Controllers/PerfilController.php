<?php

namespace App\Http\Controllers;

use App\Archivos;
use App\Http\Requests\UpdateFotoPerfil;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Auth;

class PerfilController extends Controller
{

    public function __construct()
    {
       // $this->middleware('guest');
        $this->middleware('auth');
    }

    private $profilePicturesFolder = "files";

    public function mostrarPerfil(int $id)
    {

        $user = User::findOrFail($id);
        if (auth()->user()->id === $user->id) {
        $archivo = $user->ID_archivo;
        $foto = Archivos::find($archivo);

        return view('user.perfil', compact('user', 'foto'));
        }else{
            return back();
        }
    }

    public function actualizarFoto(UpdateFotoPerfil $request) 
    {
        $archivo = $request->file('profile-picture');
        $nombreArchivo = Str::random(10) . '.' .$archivo->getClientOriginalExtension();
        
        $foto = new Archivos;
        $foto->ruta = "files" . '/' . $nombreArchivo;
        $foto->nombre = $nombreArchivo;
        $foto->save();
        $user = Auth::user();
        $archivo->move($this->profilePicturesFolder,$nombreArchivo);// subimos al servidor
        $user->ID_archivo = $foto->id; // guardamos el nombre en la bd
        $user->save(); // guardamos los cambios.

        return redirect()->route('perfil', ['id' => $user->id]);
    }

    public function editarPerfil()
    {
        return view('user.editarPerfil');
    }

}
