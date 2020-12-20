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

Route::get('/horarios/salas/','SalaController@inicio')->name('salas.salas')->middleware(['auth','user']);
Route::resource('salas','SalaController')->middleware(['auth','admin']);

//rutas de reservas
    //creacion de clases
Route::get('/reservas-salas','ReservaController@reservas')->name('reservas.salas')->middleware(['auth','user']);
Route::resource('reservas','ReservaController')->middleware(['auth','admin']);

//rutas de prestamos
Route::get('/prestamos/{prestamo}/devolver','PrestamoController@devolver')->name('prestamo.devolver');
Route::get('/prestamos/{prestamo}/sancionar','PrestamoController@sancionar')->name('prestamo.sancionar');
Route::put('/prestamos/{prestamo}','PrestamoController@update')->name('prestamo.update');
Route::resource('prestamos','PrestamoController');

// Route::get('/prestamos/{prestamo}','PrestamoController@generar')->name('prestamo.generar');

// Route::get('/prestamos/{prestamo}/Prestamo','PrestamoController@devolverPrestamo')->name('devolverPrestamo.index');

//index de user
Route::get('/','UserController@index')->name('user');
Route::get('/catalogo', 'UserController@catalogo')->name('catalogo.categorias');
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
Route::get('getCategorias', 'CategoriaEquipoController@getCategorias')->name('dropdown.categorias');
Route::get('getEquipos', 'CategoriaEquipoController@getEquipos')->name('dropdown.equipos');
Route::get('getExistencias', 'CategoriaEquipoController@getExistencias')->name('dropdown.existencias');

//rutas de autenticacion
Auth::routes();

//rutas de existencia
Route::get('/existencias/{existencia}/prestar','ExistenciaController@prestar')->name('existencias.prestar');
Route::get('/existencias/{existencia}/devolver','ExistenciaController@devolver')->name('existencias.devolver');
Route::put('/existencias/{existencia}','ExistenciaController@prestarPrestamo')->name('existencias.prestarPrestamo');
// Route::put('/existencias/{existencia}','ExistenciaController@devolverPrestamo')->name('existencias.devolverPrestamo');
Route::resource('existencias', 'ExistenciaController');

//rutas de sanciones
Route::get('/sanciones','SancionController@index')->name('sanciones.index');
Route::get('/sanciones/sancion','SancionController@create')->name('sanciones.create')->middleware('admin');
Route::post('/sanciones','SancionController@store')->name('sanciones.store')->middleware('admin');
Route::get('/sanciones/{sancion}','SancionController@show')->name('sanciones.show');
Route::get('/sanciones/{sancion}/edit','SancionController@edit')->name('sanciones.edit')->middleware('admin');
Route::put('/sanciones/{sancion}','SancionController@update')->name('sanciones.update')->middleware('admin');
Route::delete('/sanciones/{sancion}','SancionController@destroy')->name('sanciones.destroy')->middleware('admin');


//rutas de home
 Route::get('/home', 'HomeController@index')->name('home');

//index de admin
Route::get('/admin','AdminController@index')->name('admin');



//rutas de listarSolicitudes
Route::get('/listarSolicitud/entrantes','ListarSolicitudController@entrantes')->name('entrantes.index');
Route::get('/listarSolicitud/aprobadas','ListarSolicitudController@aprobadas')->name('aprobadas.index');
Route::get('/listarSolicitud/rechazadas','ListarSolicitudController@rechazadas')->name('rechazadas.index');
Route::get('/listarSolicitud/canceladas','ListarSolicitudController@canceladas')->name('canceladas.index');
 Route::get('/listarSolicitud/encursos','ListarSolicitudController@encursos')->name('encursos.index');
// Route::get('/listarSolicitud/{listarSolicitud}/Cancelar','ListarSolicitudController@encursos')->name('cancelar.edit');
// Route::get('/listarSolicitud/{listarSolicitud}/Rechazar','ListarSolicitudController@encursos')->name('rechazar.index');
Route::get('/listarSolicitud/{listarSolicitud}/Aprobar','ListarSolicitudController@cambiarEstadoAprobada')->name('cambiarEstadoAprobada.index');
Route::put('/listarSolicitud/{listarSolicitud}/cancelar','ListarSolicitudController@cambiarEstadoRechazada')->name('cambiarEstadoRechazada.index');
Route::put('/listarSolicitud/{listarSolicitud}/rechazar','ListarSolicitudController@cambiarEstadoCancelada')->name('cambiarEstadoCancelada.index');
//Route::put('/listarSolicitud/{listarSolicitud}/Rechazar','ListarSolicitudController@cambiarEstadoRechazada')->name('cambiarEstadoRechazada.index');

Route::resource('listarSolicitud','ListarSolicitudController');

//ruta de perfil

Route::get('/admin/perfil', function () {
    return view('encargado.perfil');
})->name('admin.perfil')->middleware(['auth','admin']);

Route::get('/perfil', function () {
    return view('alumno.perfil');
})->name('alumno.perfil')->middleware(['auth','user']);
