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
// Route::get('/', function () {
//     return view('auth.login');
// });

//rutas de equipos
Route::resource('equipos','EquipoController');

//rutas de sala
Route::resource('salas','SalaController');

//rutas de prestamos
Route::resource('prestamos','PrestamoController');

//rutas de solicitudes
Route::get('/solicitudes','SolicitudController@index')->name('solicitud.index')->middleware('user');
Route::get('/solicitudes/solicitud','SolicitudController@create')->name('solicitud.create')->middleware('user');
Route::post('/solicitudes','SolicitudController@store')->name('solicitud.store')->middleware('user');
Route::get('/solicitudes/{solicitud}','SolicitudController@show')->name('solicitud.show')->middleware('user');
Route::get('/solicitudes/{solicitud}/edit','SolicitudController@edit')->name('solicitud.edit')->middleware('admin');
Route::put('/solicitudes/{solicitud}','SolicitudController@update')->name('solicitud.update')->middleware('admin');
Route::delete('/solicitudes/{solicitud}','SolicitudController@destroy')->name('solicitud.destroy');

//rutas para dropdown dependiente formulario solicitud
Route::get('getCategorias', 'CategoriaEquipoController@getCategorias');
Route::get('getEquipos', 'CategoriaEquipoController@getEquipos');
Route::get('getExistencias', 'CategoriaEquipoController@getExistencias');

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
Route::put('/sanciones/{sancion}','SancionController@update')->name('sanciones.update');
Route::delete('/sanciones/{sancion}','SancionController@destroy')->name('sanciones.destroy');

//rutas de home
 Route::get('/home', 'HomeController@index')->name('home');

//index de admin
Route::get('/admin','AdminController@index')->name('admin');

//index de user
Route::get('/','UserController@index')->name('user');

//rutas de listarSolicitudes
Route::resource('listarSolicitud', 'ListarSolicitudController');

Route::get('/listarSolicitud','ListarSolicitudController@indexA')->name('aprobadas.index');

//ruta de perfil
Route::resource('perfil','PerfilController');