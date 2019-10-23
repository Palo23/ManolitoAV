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

Route::get('editar_perfil', 'PerfilController@editarPerfil')->name('perfil.editar');

Route::post('update_foto', 'PerfilController@actualizarFoto')->name('actualizarFoto');

//Route::resource('/usuario', 'RolUserController@update')->name('roluser');