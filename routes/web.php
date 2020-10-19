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

Route::get('/', function () {
    return view('auth.login');
});
Route::resource('equipos','EquipoController');
Route::resource('salas','SalaController');
/*Route::get('/equipos','EquipoController@index')->name('equipos.index');
Route::get('/equipos/equipo','EquipoController@create')->name('equipos.create');
Route::post('/equipos','EquipoController@store')->name('equipos.store');
Route::get('/equipos/{equipo}','EquipoController@show')->name('equipos.show');
Route::get('/equipos/{equipo}/edit','EquipoController@edit')->name('equipos.edit');
Route::put('/equipos/{equipo}','EquipoController@update')->name('equipos.update');
Route::delete('/equipos/{equipo}','EquipoController@destroy')->name('equipos.destroy'); */
Auth::routes();

Route::resource('existencias', 'ExistenciaController');


Route::get('/sanciones','SancionController@index')->name('sanciones.index');
Route::get('/sanciones/sancion','SancionController@create')->name('sanciones.create');
Route::post('/sanciones','SancionController@store')->name('sanciones.store');
Route::get('/sanciones/{sancion}','SancionController@show')->name('sanciones.show');
Route::get('/sanciones/{sancion}/edit','SancionController@edit')->name('sanciones.edit');
Route::put('/sancioness/{sancion}','SancionController@update')->name('sanciones.update');
Route::delete('/sanciones/{sancion}','SancionController@destroy')->name('sanciones.destroy');

Route::get('/home', 'HomeController@index')->name('home');

//index de admin
Route::get('/admin','AdminController@index')->name('admin');

//index de user
Route::get('/user','UserController@index')->name('user');

