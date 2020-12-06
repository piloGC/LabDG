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
Route::get('/prestamos/{prestamo}','PrestamoController@generar')->name('prestamo.generar');


//index de user
Route::get('/','UserController@index')->name('user');
Route::get('/catalogo', 'UserController@catalogo')->name('catalogo.categorias');
Route::get('/catalogo/todos-los-equipos', 'UserController@todosEquipos')->name('catalogo.equipos');
Route::get('/catalogo/camaras-fotograficas', 'UserController@camarasFot')->name('catalogo.fotograficas');
Route::get('/catalogo/camaras-video', 'UserController@camarasVid')->name('catalogo.videos');
Route::get('/catalogo/tripodes', 'UserController@tripode')->name('catalogo.tripodes');
Route::get('/catalogo/tabletas', 'UserController@tableta')->name('catalogo.tabletas');
Route::get('/catalogo/lectores-dvd', 'UserController@lector')->name('catalogo.lectores');
Route::get('/catalogo/{existencia}/create','UserController@create')->name('catalogo.create');
Route::get('/catalogo/{existencia}','UserController@show')->name('catalogo.show');

//rutas de reglamento
Route::get('/reglamentos','ReglamentoController@index')->name('reglamentos.index')->middleware('user');

//rutas de solicitudes
Route::get('/solicitudes','SolicitudController@index')->name('solicitud.index')->middleware('user');
Route::get('/solicitudes/solicitud','SolicitudController@create')->name('solicitud.create')->middleware('user');
Route::post('/solicitudes','SolicitudController@store')->name('solicitud.store')->middleware('user');
Route::get('/solicitudes/{solicitud}','SolicitudController@show')->name('solicitud.show')->middleware('user');
Route::get('/solicitudes/{solicitud}/edit','SolicitudController@edit')->name('solicitud.edit')->middleware('admin');
Route::put('/solicitudes/{solicitud}','SolicitudController@update')->name('solicitud.update')->middleware('admin');
Route::delete('/solicitudes/{solicitud}','SolicitudController@destroy')->name('solicitud.destroy');

//rutas de notificaciones 
//marcas todas como leidas
Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');

//ruta para marcar como leido una notificación
Route::post('/mark-as-read', 'SolicitudController@markNotification' ) ->name('markNotification');

//rutas para dropdown dependiente formulario solicitud
Route::get('getCategorias', 'CategoriaEquipoController@getCategorias');
Route::get('getEquipos', 'CategoriaEquipoController@getEquipos');
Route::get('getExistencias', 'CategoriaEquipoController@getExistencias');

//rutas de autenticacion
Auth::routes();

//rutas de existencia

Route::get('/existencias/{existencia}/devolver','ExistenciaController@devolver')->name('existencia.devolver');
Route::put('/existencias/{existencia}','ExistenciaController@devolverUpdate')->name('existencia.devolverUpdate');
Route::get('/existencias/{existencia}/prestar','ExistenciaController@prestar')->name('existencia.prestar');
Route::put('/existencias/{existencia}','ExistenciaController@prestarUpdate')->name('existencias.prestarUpdate');

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



//rutas de listarSolicitudes
Route::get('/listarSolicitud/entrantes','ListarSolicitudController@entrantes')->name('entrantes.index');
Route::get('/listarSolicitud/aprobadas','ListarSolicitudController@aprobadas')->name('aprobadas.index');
Route::get('/listarSolicitud/rechazadas','ListarSolicitudController@rechazadas')->name('rechazadas.index');

Route::get('/listarSolicitud/{listarSolicitud}/Aprobar','ListarSolicitudController@cambiarEstadoAprobada')->name('cambiarEstadoAprobada.index');
Route::get('/listarSolicitud/{listarSolicitud}/Rechazar','ListarSolicitudController@cambiarEstadoRechazada')->name('cambiarEstadoRechazada.index');

Route::get('/listarSolicitud/{listarSolicitud}/Prestamo','ListarSolicitudController@generarPrestamo')->name('generarPrestamo.index');

Route::resource('listarSolicitud', 'ListarSolicitudController');

//ruta de perfil
Route::resource('perfil','PerfilController');