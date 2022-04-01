<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;


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
Route::get('/',										'PagesController@index');
Route::get('/home',									'PagesController@index');
Auth::routes();
/* -----------------------------------------------------------------------------------
/                                   Cambio de Idioma 
/ ------------------------------------------------------------------------------------
*/
Route::get('lang/{lang}',							'LanguageController@swap')->name('lang.swap');
/*
/ ---------------------------------------------------------------------------------
/                                              Modulo C14 
/ --------------------------------------------------------------------------------- 
*/
Route::resource('clave',							'ClaveController')->middleware('role:operador|consultor|supervidor|admin|Super-Admin');

Route::get('claves/export/',     					'ClaveController@export')->middleware('auth');
Route::get('claves/grafic/',     					'ClaveController@grafica')->middleware('auth');
Route::get('/downloadPDFclave/{id}',				'ClaveController@downloadPDF')->middleware('auth');
Route::get('/sendReportClave/{id}',					'MailController@SendMailsClave')->middleware('auth');
Route::get('/gasavailablebalancemonthly/{id}',		'ClaveController@gasavailablebalancemonthly')->middleware('auth');
/*
/ ---------------------------------------------------------------------------------
/                                      Modulo Comision Servicio 
/ --------------------------------------------------------------------------------- 
*/

Route::resource('servicio',							'ServicioController')->middleware('role:operador|consultor|supervidor|admin|Super-Admin');
Route::get('servicios/export',   					'ServicioController@export')->middleware('auth');
Route::get('servicios/grafic/',    					'ServicioController@grafica')->middleware('auth');
Route::get('/downloadPDFservicio/{id}',				'ServicioController@downloadPDF')->middleware('auth');
Route::get('/sendReportServicio/{id}',				'MailController@SendMailsServicio')->middleware('auth');

/*
/ --------------------------------------------------------------------------------------------------------
/                                              Modulo Incidentes 
/ -------------------------------------------------------------------------------------------------------- 
*/

/* 
/ -------------------------------------------------------------------------------------------------------------
/                                                Sub modulo Inundacions  
/ -------------------------------------------------------------------------------------------------------------
*/


Route::get('inundacion',			            	'InundacionController@index')->name('inundacion.index')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('inundacion/create',		            	'InundacionController@create')->name('inundacion.create')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::post('inundacion/store',		            	'InundacionController@store')->name('inundacion.store')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('inundacion/show/{id}',	            	'InundacionController@show')->name('inundacion.show')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('inundacion/edit/{id}',	            	'InundacionController@edit')->name('inundacion.edit')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::patch('inundacion/{id}',                    	'InundacionController@update')->name('inundacion.update')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::delete('inundacion/{id}',              	    'InundacionController@destroy')->name('inundacion.destroy')->middleware('role:operador|supervisor|admin|Super-Admin');

Route::get('/inundacions/carga/{id}',				'InundacionController@cargar')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::post('inundacions/guardaform',				'InundacionController@upload')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::post('inundacions/import/',					'InundacionController@importacion')->middleware('rol:admin|Super-Admin');
Route::get('inundacions/importar',					'InundacionController@importar')->middleware('role:admin|Super-Admin');
Route::get('inundacions/export/', 					'InundacionController@export')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('inundacions/grafic/',					'InundacionController@grafica')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('/downloadPDFinundacion/{id}',			'InundacionController@downloadPDF')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('/sendReportInundacion/{id}',			'MailController@SendMailsInundacion')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');

/* 
/ -------------------------------------------------------------------------------------------------------------
/                                                Sub modulo Fuego  
/ -------------------------------------------------------------------------------------------------------------
*/
Route::get('fuego',							        'IncendioController@index')->name('fuego.index')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('fuego/create',							'IncendioController@create')->name('fuego.create')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::post('fuego/store',							'IncendioController@store')->name('fuego.store')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::get('fuego/show/{id}',						'IncendioController@show')->name('fuego.show')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('fuego/edit/{id}',						'IncendioController@edit')->name('fuego.edit')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::patch('fuego/{id}',					    	'IncendioController@update')->name('fuego.update')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::delete('fuego/{id}',							'IncendioController@destroy')->name('fuego.destroy')->middleware('role:operador|supervisor|admin|Super-Admin');

Route::get('/incendios/carga/{id}',					'IncendioController@cargar')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::post('incendios/guardaform',					'IncendioController@upload')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::post('incendios/import/',					'IncendioController@importacion')->middleware('role:admin|Super-Admin');
Route::get('incendios/importar',					'IncendioController@importar')->middleware('role:admin|Super-Admin');
Route::get('incendios/export',   					'IncendioController@export')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('incendios/grafic/',   					'IncendioController@grafica')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('/downloadPDFincendio/{id}',				'IncendioController@downloadPDF')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('inspeccionfuego/{id}',                  'IncendioController@inspeccion')->name('inspeccionf')->middleware('auth');
Route::put('/registrainspeccionfuego',              'IncendioController@registrainspeccion')->name('registrainspeccionfuego');
Route::get('/sendReportIncendio/{id}',				'MailController@SendMailsIncendio')->middleware('auth');


/* 
/ -------------------------------------------------------------------------------------------------------------
/                                                Sub modulo Fuga  
/ -------------------------------------------------------------------------------------------------------------
*/

Route::get('fuga',							        'FugaController@index')->name('fuga.index')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('fuga/create',							'FugaController@create')->name('fuga.create')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::post('fuga/store',							'FugaController@store')->name('fuga.store')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::get('fuga/show/{id}',						'FugaController@show')->name('fuga.show')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('fuga/edit/{id}',						'FugaController@edit')->name('fuga.edit')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::patch('fuga/{id}',					    	'FugaController@update')->name('fuga.update')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::delete('fuga/{id}',							'FugaController@destroy')->name('fuga.destroy')->middleware('role:operador|supervisor|admin|Super-Admin');

Route::get('inspeccionfuga/{id}',                   'FugaController@inspeccion')->name('inspeccionfuga')->middleware('auth');
Route::put('/registrainspeccionfuga',               'FugaController@registrainspeccion')->name('registrainspeccionfuga');

Route::get('/fugas/carga/{id}',						'FugaController@cargar')->middleware('auth');
Route::post('fugas/guardaform',						'FugaController@upload')->middleware('auth');
Route::post('fugas/import/',						'FugaController@importacion')->middleware('role:admin');
Route::get('fugas/importar',						'FugaController@importar')->middleware('role:admin');
Route::get('fugas/export',   						'FugaController@export')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('fugas/grafic/',     					'FugaController@grafica');
Route::get('/downloadPDFfuga/{id}',					'FugaController@downloadPDF')->middleware('auth');
Route::get('/sendReportFuga/{id}',					'MailController@SendMailsFuga')->middleware('auth');

/* 
/ -------------------------------------------------------------------------------------------------------------
/                                                Sub modulo rescate  
/ -------------------------------------------------------------------------------------------------------------
*/

Route::get('rescate',							    'RescateController@index')->name('rescate.index')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('rescate/create',						'RescateController@create')->name('rescate.create')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::post('rescate/store',						'RescateController@store')->name('rescate.store')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::get('rescate/show/{id}',						'RescateController@show')->name('rescate.show')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('rescate/edit/{id}',						'RescateController@edit')->name('rescate.edit')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::patch('rescate/{id}',					    'RescateController@update')->name('rescate.update')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::delete('rescate/{id}',						'RescateController@destroy')->name('rescate.destroy')->middleware('role:operador|supervisor|admin|Super-Admin');

Route::get('/rescates/carga/{id}',					'RescateController@cargar')->middleware('auth');
Route::post('rescates/guardaform',					'RescateController@upload')->middleware('auth');
Route::post('rescates/import/',						'RescateController@importacion')->middleware('role:admin|Super-Admin');
Route::get('rescates/importar',						'RescateController@importar')->middleware('role:admin');
Route::get('rescates/export/',    					'RescateController@export')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('rescates/grafic/',   					'RescateController@grafica');
Route::get('/downloadPDFrescate/{id}',				'RescateController@downloadPDF')->middleware('auth');
Route::get('/sendReportRescate/{id}',				'MailController@SendMailsRescate')->middleware('auth');


/* --------------------------------------- Sub modulo transito ----------------------- */
Route::get('transito',							    'TransitoController@index')->name('transito.index')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('transito/create',						'TransitoController@create')->name('transito.create')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::post('transito/store',						'TransitoController@store')->name('transito.store')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::get('transito/show/{id}',						'TransitoController@show')->name('transito.show')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('transito/edit/{id}',						'TransitoController@edit')->name('transito.edit')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::patch('transito/{id}',					    'TransitoController@update')->name('transito.update')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::delete('transito/{id}',						'TransitoController@destroy')->name('transito.destroy')->middleware('role:operador|supervisor|admin|Super-Admin');

Route::get('/transitos/carga/{id}',					'TransitoController@cargar')->middleware('auth');
Route::post('transitos/guardaform',					'TransitoController@upload')->middleware('auth');
Route::post('transitos/import/',					'TransitoController@importacion')->middleware('role:admin|Super-Admin');
Route::get('transitos/importar',					'TransitoController@importar')->middleware('role:admin|Super-Admin');
Route::get('transitos/export/', 					'TransitoController@export')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('transitos/grafic/',   					'TransitoController@grafica')->middleware('auth');
Route::get('/downloadPDFtransito/{id}',				'TransitoController@downloadPDF')->middleware('auth');
Route::get('/sendReportTransito/{id}',				'MailController@SendMailsTransito')->middleware('auth');



/* --------------------------------------- Sub modulo Salud ----------------------- */

Route::get('salud',					    		    'SaludController@index')->name('salud.index')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('salud/create',				    		'SaludController@create')->name('salud.create')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::post('salud/store',					    	'SaludController@store')->name('salud.store')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::get('salud/show/{id}',				    	'SaludController@show')->name('salud.show')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('salud/edit/{id}',					    'SaludController@edit')->name('salud.edit')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::patch('salud/{id}',					        'SaludController@update')->name('salud.update')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::delete('salud/{id}',						    'SaludController@destroy')->name('salud.destroy')->middleware('role:operador|supervisor|admin|Super-Admin');


Route::get('/saluds/carga/{id}',					'SaludController@cargar')->middleware('auth');
Route::post('saluds/guardaform',					'SaludController@upload')->middleware('auth');
Route::post('saluds/import/',						'SaludController@importacion')->middleware('role:admin|Super-Admin');
Route::get('saluds/importar',						'SaludController@importar')->middleware('role:admin|Super-Admin');
Route::get('saluds/export',   						'SaludController@export')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('saluds/grafic/',     					'SaludController@grafica')->middleware('auth');
Route::get('/downloadPDFsalud/{id}',				'SaludController@downloadPDF')->middleware('auth');
Route::get('/sendReportSalud/{id}',					'MailController@SendMailsSalud')->middleware('auth');

/* --------------------------------------- Sub modulo derrame ----------------------- */

Route::get('derrame',				    		    'DerrameController@index')->name('derrame.index')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('derrame/create',			    		'DerrameController@create')->name('derrame.create')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::post('derrame/store',				    	'DerrameController@store')->name('derrame.store')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::get('derrame/show/{id}',				    	'DerrameController@show')->name('derrame.show')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('derrame/edit/{id}',					    'DerrameController@edit')->name('derrame.edit')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::patch('derrame/{id}',				        'DerrameController@update')->name('derrame.update')->middleware('role:operador|supervisor|admin|Super-Admin');
Route::delete('derrame/{id}',					    'DerrameController@destroy')->name('derrame.destroy')->middleware('role:operador|supervisor|admin|Super-Admin');

Route::get('inspeccionderrame/{id}',                'DerrameController@inspeccion')->name('inspeccionderrame')->middleware('auth');
Route::put('/registrainspeccionderrame',            'DerrameController@registrainspeccion')->name('registrainspeccionderrame');
Route::get('/derrames/carga/{id}',					'DerrameController@cargar')->middleware('auth');
Route::post('derrames/guardaform',					'DerrameController@upload')->middleware('auth');
Route::post('derrames/import/',						'DerrameController@importacion')->middleware('role:admin|Super-Admin');
Route::get('derrames/importar',						'DerrameController@importar')->middleware('role:admin|Super-Admin');
Route::get('derrames/export',   					'DerrameController@export')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('derrames/grafic/',     					'DerrameController@grafica')->middleware('auth');
Route::get('/downloadPDFderrame/{id}',				'DerrameController@downloadPDF')->middleware('auth');
Route::get('/sendReportDerrame/{id}',				'MailController@SendMailsDerrame')->middleware('auth');

/* --------------------------------------- Sub modulo Parametrizacion ----------------------- */

Route::resource('incidente',						'IncidenteController')->middleware('role:supervidor|admin|Super-Admin');
Route::resource('gasolinera',						'GasolineraController')->middleware('role:supervidor|admin|Super-Admin');
Route::resource('estacion',							'StationController')->middleware('role:admin|supervidor|Super-Admin');
Route::resource('parroquia',						'ParroquiaController')->middleware('role:admin|supervidor|Super-Admin');
Route::get('/activitylog',							'ConsultasController@activitylog');
Route::post('cie10/import/',						'CieController@importacion')->middleware('role:admin|Super-Admin');
Route::get('cie10/importar',						'CieController@importar')->middleware('role:admin|supervidor|Super-Admin');
Route::get('incidentes/export/', 					'IncidenteController@export')->middleware('role:admin|supervidor|Super-Admin');
Route::get('stations/export/',   					'StationController@export')->middleware('role:admin|supervidor|Super-Admin');
Route::get('parroquias/export/', 					'ParroquiaController@export')->middleware('role:admin|supervidor|Super-Admin');
Route::resource('vehiculo',							'VehiculoController')->middleware('role:admin|supervidor|Super-Admin');
Route::post('vehiculos/import/',					'VehiculoController@importacion')->middleware('role:admin|Super-Admin');
Route::get('vehiculos/importar',					'VehiculoController@importar')->middleware('role:admin|Super-Admin');
Route::get('vehiculos/grafic/',						'VehiculoController@grafica')->middleware('role:admin|supervidor|Super-Admin');
Route::get('vehiculos/export/',    					'VehiculoController@export')->middleware('role:admin|supervidor|Super-Admin');
/* 
/ -------------------------------------------------------------------------------------
/ --------------------------------------- Sub modulo Usuarios 
/ ------------------------------------------------------------------------------------
*/
//Rutas Permisos Usuarios 
Route::get('users/permisosxrol/{id}',				'UserController@PerrmisosxRol')->middleware('role:admin|Super-Admin');
Route::get('users/consultarol/{id}',				'UserController@ConsultaRolUsuario')->name('consultrol')->middleware('role:admin|Super-Admin');
Route::get('users/roles',							'UserController@rol')->middleware('role:admin|Super-Admin');
Route::get('profile/edit/{id}',   					'UserController@edit')->name('profile.edit')->middleware('role:admin|Super-Admin');
Route::put('users/changerol',						'UserController@CambiaRoldeUsuario')->name('changerol')->middleware('role:admin|Super-Admin');
Route::put('users/createpermiso',					'UserController@createpermiso')->name('createpermiso')->middleware('role:admin|Super-Admin');
Route::put('users/cambiapermisosarol/',				'UserController@CambiaPermisosRol')->name('changepermissions')->middleware('role:admin|Super-Admin');
Route::get('profile/perfil', 						'ProfileController@index')->name('profile.index')->middleware('auth');
Route::put('profile/perfil', 						'ProfileController@update')->name('profile.update')->middleware('auth');
Route::put('profile/pass', 							'ProfileController@pass')->name('profile.pass')->middleware('auth');
Route::put('profile/avatar', 						'ProfileController@update_avatar')->name('profile.avatar')->middleware('auth');
Route::get('users/permisos',						'UserController@permisos')->middleware('role:admin|Super-Admin');
Route::get('users/importar',						'UserController@importar')->middleware('role:admin|Super-Admin');

/* --------------------------------------- Sub modulo Estadisticas    ----------------------- */

Route::resource('consulta',							'ConsultasController');
Route::get('/consultaentrefechas',					'ConsultasController@consultaentrefechas')->name('consultaentrefechas');
Route::get('/googlemymapsoptions',			        'ConsultasController@googlemymapsoptions')->name('googlemymapsoptions');
Route::get('/googlemymaps',		        			'ConsultasController@googlemymaps')->name('googlemymaps');
Route::get('googlemymapsjson/{tabla},{f1},{f2}',    'ConsultasController@GetjsonMaps')->name('jsongooglemymaps');
Route::get('/busquedaentrefechas',					'ConsultasController@busquedaentrefechas');
Route::get('/busquedaentrefechasclaveveh',			'ConsultasController@busquedaentrefechasclaveveh');
Route::get('/busquedaentrefechasclave',				'ConsultasController@busquedaentrefechasclave');
Route::get('/busquedaentrefechasincidenteveh',		'ConsultasController@busquedaentrefechasincidenteveh');
Route::get('/busquedaentrefechasmov',				'MovilizacionController@busquedaentrefechas');
Route::post('users/import/',						'UserController@importacion')->middleware('role:admin|Super-Admin');
Route::resource('user',								'UserController');


Route::get('estadisticas/export/{id},{f1},{f2}', 	'ConsultasController@export')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('estadisticas/export4/{id},{f1},{f2}', 	'ConsultasController@export4')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('estadisticas/export3/{id},{f1},{f2}', 	'ConsultasController@export3')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('estadisticas/export2/{id},{f1},{f2}', 	'ConsultasController@export2')->middleware('role:operador|consultor|supervisor|admin|Super-Admin');
Route::get('/download/{file}', 						'DownloadsController@download');

/* --------------------------------------- Sub modulo Movilizacion    ----------------------- */

Route::get('prevencion',				    	    'MovilizacionController@index')->name('prevencion.index')->middleware('role:inspector|consultor|admin|Super-Admin');
Route::get('prevencion/create',			    		'MovilizacionController@create')->name('prevencion.create')->middleware('role:inspector|admin|Super-Admin');
Route::post('prevencion/store',				    	'MovilizacionController@store')->name('prevencion.store')->middleware('role:inspector|admin|Super-Admin');
Route::get('prevencion/show/{id}',			    	'MovilizacionController@show')->name('prevencion.show')->middleware('role:inspector|consultor|admin|Super-Admin');
Route::get('prevencion/edit/{id}',				    'MovilizacionController@edit')->name('prevencion.edit')->middleware('role:inspector|admin|Super-Admin');
Route::patch('prevencion/{id}',				        'MovilizacionController@update')->name('prevencion.update')->middleware('role:inspector|admin|Super-Admin');
Route::delete('prevencion/{id}',				    'MovilizacionController@destroy')->name('prevencion.destroy')->middleware('role:inspector|admin|Super-Admin');
Route::get('prevencions/export',   					'MovilizacionController@export')->middleware('role:inspector|admin|Super-Admin');
Route::get('prevencions/export1/{id},{f1},{f2}', 	'MovilizacionController@export1')->middleware('role:inspector|admin|Super-Admin');
Route::get('prevencions/export2/{id},{f1},{f2}', 	'MovilizacionController@export2')->middleware('role:inspector|admin|Super-Admin');
Route::get('prevencions/export3/{f1},{f2}', 	    'MovilizacionController@export3')->middleware('role:inspector|admin|Super-Admin');
Route::get('prevencions/grafic/',    				'MovilizacionController@grafica')->middleware('role:inspector|admin|Super-Admin');
Route::get('/downloadPDFmovilizacion/{id}', 		'MovilizacionController@downloadPDF')->middleware('role:inspector|admin|Super-Admin');
Route::get('/sendReportMovilizacion/{id}',			'MailController@SendMailsMovilizacion')->middleware('role:inspector|admin|Super-Admin');
Route::get('/sendReportPrevencion/{id}',			'MailController@SendMailsPrevencion')->middleware('role:inspector|admin|Super-Admin');
Route::get('/consultaentrefechasmov',	        	'MovilizacionController@consultaentrefechas')->name('consultaentrefechasmov')->middleware('role:inspector|admin|Super-Admin');

/* ----------------------------------------------------------------------------------------------
/                                   Rutas SubSistema Reservas de vehiculos
/
/ ------------------------------------------------------------------------------------------------
*/
Route::get('/solicitud/calendar',       'Reservacion\ReservacionController@chequearcalendario')->middleware('role:employee|assistant|admin|Super-Admin');
Route::get('/solicitud/asistencia',     'Reservacion\ReservacionController@formasistencia')->middleware('role:employee|assistant|admin|Super-Admin');
/* Route::get('/miJqueryAjax/{id}',		'Reservacion\AjaxController@index')->middleware('auth'); */
Route::resource('solicitud',         	'Reservacion\UserSolicitudsController')->middleware('role:employee|assistant|admin|Super-Admin');
Route::get('/solicitud/calendar',		'Reservacion\UserSolicitudsController@calendar')->name('user.solicitud.calendar')->middleware('role:employee|assistant|admin|Super-Admin');
Route::resource('/administrar', 		'Reservacion\AdminReservationsController')->middleware('role:assistant|admin|Super-Admin');
Route::get('/administrar/grafic/',   	'Reservacion\AdminReservationsController@grafica')->name('admin.solicitud.grafic')->middleware('role:employee|assistant|admin|Super-Admin');
Route::get('vehiculosdisponibles',      'Reservacion\ReservacionController@VehiculosDisponibles')->middleware('role:employee|assistant|admin|Super-Admin');
Route::get('/uath',                     'Reservacion\ReservacionController@index')->middleware('role:employee|assistant|admin|Super-Admin');

/* ----------------------------------------------------------------------------------------------
/                                   Rutas Menu Principal
/
/ ------------------------------------------------------------------------------------------------
*/

Route::get('/eventoE1/',							'MenuController@evento')->middleware('auth');
Route::get('/eventoE2/',							'MenuController@evento2')->middleware('auth');
Route::get('/eventoE3/',							'MenuController@evento3')->middleware('auth');
Route::get('/eventoE4/',							'MenuController@evento4')->middleware('auth');
Route::get('/eventoE5/',							'MenuController@evento5')->middleware('auth');
Route::get('/eventoE6/',							'MenuController@evento6')->middleware('auth');
Route::get('/eventoE7/',							'MenuController@evento7')->middleware('auth');
Route::get('/eventoE8/',							'MenuController@evento8')->middleware('auth');
Route::get('/eventoE9/',							'MenuController@evento9')->middleware('auth');
Route::get('/refresh/',							    'MenuController@refrescamiento');

// Rotas Creacion QR
Route::get('qrcode',                                'MenuController@qrcode_blade')->middleware(('auth'));



    