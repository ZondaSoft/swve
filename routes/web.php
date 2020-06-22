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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

// La ruta Home se usa para crud e Legajos
//Route::get('/home/{id?}', 'HomeController@index')->name('home')->where('id', '[0-9]+');
Route::get('/home/{id?}/{direction?}', 'HomeController@index')->where(['id' => '[0-9]+', 'direction' => '[-1-9]+']);
Route::get('/home/add', 'HomeController@add')->name('home');
Route::post('/home/add', 'HomeController@store');
Route::get('/home/edit/{id}', 'HomeController@edit')->name('home')->where('id', '[0-9]+');
Route::post('/home/edit/{id}', 'HomeController@update');
Route::get('/home/search/', 'HomeController@search')->name('home.search');
Route::get('/home/{id?}/search/', 'HomeController@search')->name('search');
Route::get('/home/{id?}/{direction?}/search/', 'HomeController@search')->name('search');
Route::get('/home/delete/{id}', 'HomeController@delete'); // ->name('home');

Route::get('/test', 'HomeController@test');

// Busqueda de legajos
Route::get('/home/search2', 'HomeController@search2')->name('search2');
Route::get('/home/search3', 'HomeController@search3')->name('search3');

// La ruta empresa es para datos fijos de la empresa
Route::get('/datosempresa/{id?}', 'EmpresaController@index')->name('home')->where('id', '[0-9]+');
Route::get('/datosempresa/add', 'EmpresaController@add')->name('home');
Route::get('/datosempresa/add/{id?}', 'EmpresaController@add')->name('home');
Route::post('/datosempresa/add', 'EmpresaController@store');
Route::post('/datosempresa/add/{id?}', 'EmpresaController@store');
Route::post('/datosempresa/edit/{id}', 'EmpresaController@update');
Route::get('/datosempresa/{id}/search', 'EmpresaController@index');
Route::get('/datosempresa/search', 'EmpresaController@index');
Route::get('/datosempresa/{id}/search/search', 'EmpresaController@index');

// Rutas de Bajas
//Route::get('/bajas/{id?}', 'BajasController@index')->where('id', '[0-9]+');
Route::get('/bajas/{id?}/{direction?}', 'BajasController@index')->where(['id' => '[0-9]+', 'direction' => '[-1-9]+']);
Route::get('/bajas/add', 'BajasController@add')->name('bajas');
Route::post('/bajas/add', 'BajasController@store');
Route::get('/bajas/search', 'BajasController@search')->name('bajas.search');
Route::get('/bajas/edit/{id}', 'BajasController@edit')->name('bajas')->where('id', '[0-9]+');
Route::post('/bajas/edit/{id}', 'BajasController@update');

Route::post('/vender/{id}', 'BajasController@vender');
Route::post('/vender/confirmar/{id}', 'BajasController@vender_confirma');

Route::post('/baja_otros/{id}', 'BajasController@baja_otros');
Route::post('/baja_otros/confirmar/{id}', 'BajasController@baja_otros_confirma');

// Baja o venta
//Route::get('/baja_venta/add', 'VentasController@add')->name('bajas');
Route::post('/baja_venta/add', 'VentasController@store');
Route::get('/baja_venta/edit/{id}', 'VentasController@edit'); // ->name('home');
Route::post('/baja_venta/edit/{id}', 'VentasController@update'); // ->name('home');
Route::post('/baja_venta/delete/{id}', 'VentasController@delete');
Route::post('/baja_venta/delete_drop/{id}/{page?}', 'VentasController@delete_drop'); // ->name('home');
Route::post('/baja_venta/delete_drop/{id}', 'VentasController@delete_drop'); // ->name('home');

// Comprador
Route::get('/comprador/add', 'CompradorController@add')->name('bajas');
Route::post('/comprador/add', 'CompradorController@store');
Route::get('/comprador/edit/{id}', 'CompradorController@edit'); // ->name('home');
Route::post('/comprador/edit/{id}', 'CompradorController@update'); // ->name('home');
Route::post('/comprador/delete/{id}', 'CompradorController@delete');
Route::post('/comprador/delete_drop/{id}/{page?}', 'CompradorController@delete_drop'); // ->name('home');
Route::post('/comprador/delete_drop/{id}', 'CompradorController@delete_drop'); // ->name('home');


// Libre deuda de multas
Route::get('/libredmultas/add', 'LibredMController@add')->name('bajas');
Route::post('/libredmultas/add', 'LibredMController@store');
Route::get('/libredmultas/edit/{id}', 'LibredMController@edit'); // ->name('home');
Route::post('/libredmultas/edit/{id}', 'LibredMController@update'); // ->name('home');
Route::post('/libredmultas/delete/{id}', 'LibredMController@delete');
Route::post('/libredmultas/delete_drop/{id}/{page?}', 'LibredMController@delete_drop'); // ->name('home');
Route::post('/libredmultas/delete_drop/{id}', 'LibredMController@delete_drop'); // ->name('home');

// Libre deuda de paten.
Route::get('/libredpatente/add', 'LibredPController@add')->name('bajas');
Route::post('/libredpatente/add', 'LibredPController@store');
Route::get('/libredpatente/edit/{id}', 'LibredPController@edit'); // ->name('home');
Route::post('/libredpatente/edit/{id}', 'LibredPController@update'); // ->name('home');
Route::post('/libredpatente/delete/{id}', 'LibredPController@delete');
Route::post('/libredpatente/delete_drop/{id}/{page?}', 'LibredPController@delete_drop'); // ->name('home');
Route::post('/libredpatente/delete_drop/{id}', 'LibredPController@delete_drop'); // ->name('home');


// Informe de Dominio
Route::get('/dominio/add', 'DominioInfController@add')->name('bajas');
Route::post('/dominio/add', 'DominioInfController@store');
Route::get('/dominio/edit/{id}', 'DominioInfController@edit'); // ->name('home');
Route::post('/dominio/edit/{id}', 'DominioInfController@update'); // ->name('home');
Route::post('/dominio/delete/{id}', 'DominioInfController@delete');
Route::post('/dominio/delete_drop/{id}/{page?}', 'DominioInfController@delete_drop'); // ->name('home');
Route::post('/dominio/delete_drop/{id}', 'DominioInfController@delete_drop'); // ->name('home');



// Informe de Dominio
Route::get('/denuncia/add', 'DenunciaController@add')->name('bajas');
Route::post('/denuncia/add', 'DenunciaController@store');
Route::get('/denuncia/edit/{id}', 'DenunciaController@edit'); // ->name('home');
Route::post('/denuncia/edit/{id}', 'DenunciaController@update'); // ->name('home');
Route::post('/denuncia/delete/{id}', 'DenunciaController@delete');
Route::post('/denuncia/delete_drop/{id}/{page?}', 'DenunciaController@delete_drop'); // ->name('home');
Route::post('/denuncia/delete_drop/{id}', 'DenunciaController@delete_drop'); // ->name('home');



// Informe de Dominio
Route::get('/policial/add', 'PolicialController@add')->name('bajas');
Route::post('/policial/add', 'PolicialController@store');
Route::get('/policial/edit/{id}', 'PolicialController@edit'); // ->name('home');
Route::post('/policial/edit/{id}', 'PolicialController@update'); // ->name('home');
Route::post('/policial/delete/{id}', 'PolicialController@delete');
Route::post('/policial/delete_drop/{id}/{page?}', 'PolicialController@delete_drop'); // ->name('home');
Route::post('/policial/delete_drop/{id}', 'PolicialController@delete_drop'); // ->name('home');


// Informe de Dominio
Route::get('/ceta/add', 'CetaController@add')->name('bajas');
Route::post('/ceta/add', 'CetaController@store');
Route::get('/ceta/edit/{id}', 'CetaController@edit'); // ->name('home');
Route::post('/ceta/edit/{id}', 'CetaController@update'); // ->name('home');
Route::post('/ceta/delete/{id}', 'CetaController@delete');
Route::post('/ceta/delete_drop/{id}/{page?}', 'CetaController@delete_drop'); // ->name('home');
Route::post('/ceta/delete_drop/{id}', 'CetaController@delete_drop'); // ->name('home');




// F381
Route::get('/f381/add', 'F381Controller@add')->name('bajas');
Route::post('/f381/add', 'F381Controller@store');
Route::get('/f381/edit/{id}', 'F381Controller@edit'); // ->name('home');
Route::post('/f381/edit/{id}', 'F381Controller@update'); // ->name('home');
Route::post('/f381/delete/{id}', 'F381Controller@delete');
Route::post('/f381/delete_drop/{id}/{page?}', 'F381Controller@delete_drop'); // ->name('home');
Route::post('/f381/delete_drop/{id}', 'F381Controller@delete_drop'); // ->name('home');

// DNRPA F13
Route::get('/dnrpa/add', 'DnrpaController@add')->name('bajas');
Route::post('/dnrpa/add', 'DnrpaController@store');
Route::get('/dnrpa/edit/{id}', 'DnrpaController@edit'); // ->name('home');
Route::post('/dnrpa/edit/{id}', 'DnrpaController@update'); // ->name('home');
Route::post('/dnrpa/delete/{id}', 'DnrpaController@delete');
Route::post('/dnrpa/delete_drop/{id}/{page?}', 'DnrpaController@delete_drop'); // ->name('home');
Route::post('/dnrpa/delete_drop/{id}', 'DnrpaController@delete_drop'); // ->name('home');

// Rutas de Tipos de Vehiculos
Route::get('/tipos/{id?}', 'GruposController@index')->where('id', '[0-9]+');
Route::get('/tipos/add', 'GruposController@add');
Route::post('/tipos/add', 'GruposController@store');
Route::get('/tipos/edit/{id}', 'GruposController@edit'); // ->name('home');
Route::post('/tipos/edit/{id}', 'GruposController@update'); // ->name('home');
Route::get('/tipos/delete/{id}', 'GruposController@delete'); // ->name('home');
Route::get('/tipos/search', 'GruposController@search')->name('tipos.search');
Route::get('/tipos/{id}/search', 'GruposController@search'); // ->name('home');

// RTO
Route::get('/rto/add', 'RtoController@add');
Route::post('/rto/add/{id?}', 'RtoController@store');
Route::get('/rto/edit/{id}', 'RtoController@edit'); // ->name('home');
Route::post('/rto/edit/{id}', 'RtoController@update'); // ->name('home');
Route::post('/rto/delete/{id}', 'RtoController@delete');
Route::post('/rto/delete_drop/{id}/{page?}', 'RtoController@delete_drop'); // ->name('home');
Route::post('/rto/delete_drop/{id}', 'RtoController@delete_drop'); // ->name('home');


// Siniestros
Route::get('/siniestros/add', 'SiniesController@add');
Route::post('/siniestros/add', 'SiniesController@store');
Route::get('/siniestros/edit/{id}', 'SiniesController@edit'); // ->name('home');
Route::post('/siniestros/edit/{id}', 'SiniesController@update'); // ->name('home');
Route::post('/siniestros/delete/{id}', 'SiniesController@delete');
Route::post('/siniestros/delete_drop/{id}/{page?}', 'SiniesController@delete_drop'); // ->name('home');
Route::post('/siniestros/delete_drop/{id}', 'SiniesController@delete_drop'); // ->name('home');


// Siniestros sufridos
Route::get('/sinies3/add', 'SiniesTercController@add');
Route::post('/sinies3/add', 'SiniesTercController@store');
Route::get('/sinies3/edit/{id}', 'SiniesTercController@edit'); // ->name('home');
Route::post('/sinies3/edit/{id}', 'SiniesTercController@update'); // ->name('home');
Route::post('/sinies3/delete/{id}', 'SiniesTercController@delete');
Route::post('/sinies3/delete_drop/{id}/{page?}', 'SiniesTercController@delete_drop'); // ->name('home');
Route::post('/sinies3/delete_drop/{id}', 'SiniesTercController@delete_drop'); // ->name('home');

// Multas
Route::get('/multas/add', 'MultasControllers@add');
Route::post('/multas/add', 'MultasController@store');
Route::get('/multas/edit/{id}', 'MultasController@edit'); // ->name('home');
Route::post('/multas/edit/{id}', 'MultasController@update'); // ->name('home');
Route::post('/multas/delete/{id}', 'MultasController@delete');
Route::post('/multas/delete_drop/{id}/{page?}', 'MultasController@delete_drop'); // ->name('home');
Route::post('/multas/delete_drop/{id}', 'MultasController@delete_drop'); // ->name('home');

// Factura de venta
Route::get('/factura/add', 'FacturaControllers@add');
Route::post('/factura/add', 'FacturaController@store');
Route::get('/factura/edit/{id}', 'FacturaController@edit'); // ->name('home');
Route::post('/factura/edit/{id}', 'FacturaController@update'); // ->name('home');
Route::post('/factura/delete/{id}', 'FacturaController@delete');
Route::post('/factura/delete_drop/{id}/{page?}', 'FacturaController@delete_drop'); // ->name('home');
Route::post('/factura/delete_drop/{id}', 'FacturaController@delete_drop'); // ->name('home');


// Estadisticas
Route::get('/estadisticas', 'EstadisticasController@index')->where('id', '[0-9]+');

// Rutas de informes (novedades)
Route::get('/infvehiculo/', 'InfNovedController@index'); // ->name('home');
Route::post('/infvehiculo/print', 'InfNovedController@printpdf');  // Total General por empresa
Route::post('/infvehiculo/print2', 'InfNovedController@printpdf2');  // Total General por empresa
Route::post('/infvehiculo/print3', 'InfNovedController@printpdf');  // Total General por empresa

// Rutas de informes (novedades)
Route::get('/infnovedades', 'InfNovedController@novedades'); // ->name('home');
Route::get('/infembargos', 'InfNovedController@embargos'); // ->name('home');
Route::get('/inffichadas', 'InfNovedController@fichadas'); // ->name('home');

// Pagos a realizar
Route::get('/infpagos/', 'InfPagosController@index'); // ->name('home');
Route::post('/infpagos/print', 'InfPagosController@printpdf');  // Total General por empresa
Route::post('/infpagos/print2', 'InfPagosController@printpdf2');  // Total General por empresa
Route::post('/infpagos/print3', 'InfPagosController@printpdf');  // Total General por empresa

Route::get('logout', function() {
    Auth::logout();
    return redirect('/login');
 }); // ->name('home');

// Tareas para calendario
Route::resource('tasks', 'TasksController');

include __DIR__ . '/autocomplete.php';
