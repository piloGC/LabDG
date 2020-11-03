<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/', function () {
    return view('auth.login');
});

//rutas de equipos
Route::resource('equipos','EquipoController');

//rutas de sala
Route::resource('salas','SalaController');

//rutas de pretamos
Route::resource('prestamos','PrestamoController');


//rutas de autenticacion
Auth::routes();

//rutas de existencia
Route::resource('existencias', 'ExistenciaController');

//rutas de sanciones
Route::get('/sanciones','SancionController@index')->name('sanciones.index');
Route::get('/sanciones/sancion','SancionController@create')->name('sanciones.create');
Route::post('/sanciones','SancionController@store')->name('sanciones.store');
Route::get('/sanciones/{sancion}','SancionController@show')->name('sanciones.show');
Route::get('/sanciones/{sancion}/edit','SancionController@edit')->name('sanciones.edit');
Route::put('/sancioness/{sancion}','SancionController@update')->name('sanciones.update');
Route::delete('/sanciones/{sancion}','SancionController@destroy')->name('sanciones.destroy');

//rutas de home
 Route::get('/home', 'HomeController@index')->name('home');

//index de admin
Route::get('/admin','AdminController@index')->name('admin');

//index de user
Route::get('/user','UserController@index')->name('user');

