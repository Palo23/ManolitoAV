<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

//Route::get('/', 'RolController@index')->name('home');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/roles', 'RolController');

Route::get('/asignar', 'RolController@asignar')->name('roles.asignar');

Route::get('/perfil/{id}', 'PerfilController@mostrarPerfil')->name('perfil');

Route::post('update_foto', 'PerfilController@actualizarFoto')->name('actualizarFoto');

Route::apiResource('usuarios', 'UsuariosController');

Route::apiResource('cursosCreacion', 'CursoProfesorController');

Route::apiResource('inscripcion', 'InscripcionController');

Route::get('/users', 'HomeController@usuario')->name('usuario.tabla');

Route::post('inscribir', 'HomeController@inscribirse')->name('inscribirse');

Route::get('/search', 'HomeController@search')->name('home.search');

Route::get('vistageneral/{id}', 'GeneralController@show')->name('vistaCurso');

Route::get('/editarCurso/{id}', 'EditarCursoController@show')->name('edicion');

Route::post('update_cursoph/{id}', 'EditarCursoController@actualizarFotoCurso')->name('actualizarFotoCurso');


//Route::resource('/usuario', 'RolUserController@update')->name('roluser');