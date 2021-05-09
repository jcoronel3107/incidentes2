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
Route::get('/home',									'HomeController@index');

Route::get('/admin',								'AdministradorController@index');
Auth::routes();
Route::get('lang/{lang}',							'LanguageController@swap')->name('lang.swap');
Route::resource('clave',							'ClaveController')->middleware('auth');
Route::resource('incidente',						'IncidenteController')->middleware('auth');
Route::resource('inundacion',						'InundacionController')->middleware('auth');
Route::resource('gasolinera',						'GasolineraController')->middleware('auth');
Route::resource('vehiculo',							'VehiculoController')->middleware('auth');
Route::resource('estacion',							'StationController')->middleware('auth');
Route::resource('parroquia',						'ParroquiaController')->middleware('auth');
Route::resource('fuego',							'IncendioController')->middleware('auth');
Route::resource('fuga',								'FugaController')->middleware('auth');
Route::resource('rescate',							'RescateController')->middleware('auth');
Route::resource('transito',							'TransitoController')->middleware('auth');
Route::resource('salud',							'SaludController')->middleware('auth');
Route::resource('derrame',							'DerrameController')->middleware('auth');
Route::resource('servicio',							'ServicioController')->middleware('auth');
Route::resource('consulta',							'ConsultasController')->middleware('auth');
Route::resource('user',								'UserController')->middleware('auth');
Route::resource('prevencion',						'MovilizacionController')->middleware('auth');

//Rutas Carga Formularios Inspeccion Prevencion
Route::get('inspeccionderrame/{id}',              'DerrameController@inspeccion')->name('inspeccionderrame')->middleware('auth');
Route::get('inspeccionfuga/{id}',                 'FugaController@inspeccion')->name('inspeccionfuga')->middleware('auth');
Route::get('inspeccionfuego/{id}',                'IncendioController@inspeccion')->name('inspeccionf')->middleware('auth');


Route::put('/registrainspeccionfuga',               'FugaController@registrainspeccion')->name('registrainspeccionfuga');
Route::put('/registrainspeccionderrame',            'DerrameController@registrainspeccion')->name('registrainspeccionderrame');
Route::put('/registrainspeccionfuego',              'IncendioController@registrainspeccion')->name('registrainspeccionfuego');

Route::get('/activitylog',							'ConsultasController@activitylog');
Route::get('/consultaentrefechas',					'ConsultasController@consultaentrefechas')->name('consultaentrefechas');
Route::get('/busquedaentrefechas',					'ConsultasController@busquedaentrefechas');

Route::get('/download/{file}', 						'DownloadsController@download');

//Rutas Carga Formularios Archivos PDF
Route::get('/inundacions/carga/{id}',				'InundacionController@cargar')->middleware('auth');
Route::get('/derrames/carga/{id}',					'DerrameController@cargar')->middleware('auth');
Route::get('/incendios/carga/{id}',					'IncendioController@cargar')->middleware('auth');
Route::get('/rescates/carga/{id}',					'RescateController@cargar')->middleware('auth');
Route::get('/transitos/carga/{id}',					'TransitoController@cargar')->middleware('auth');
Route::get('/saluds/carga/{id}',					'SaludController@cargar')->middleware('auth');
Route::get('/fugas/carga/{id}',						'FugaController@cargar');
Route::post('inundacions/guardaform',				'InundacionController@upload');
Route::post('derrames/guardaform',					'DerrameController@upload');
Route::post('incendios/guardaform',					'IncendioController@upload');
Route::post('rescates/guardaform',					'RescateController@upload');
Route::post('transitos/guardaform',					'TransitoController@upload');
Route::post('saluds/guardaform',					'SaludController@upload');
Route::post('fugas/guardaform',						'FugaController@upload');
//Rutas para realizar importacion de informacion desde Excel
Route::post('cie10/import/',						'CieController@importacion');
Route::post('inundacions/import/',					'InundacionController@importacion');
Route::post('rescates/import/',						'RescateController@importacion');
Route::post('transitos/import/',					'TransitoController@importacion');
Route::post('incendios/import/',					'IncendioController@importacion');
Route::post('fugas/import/',						'FugaController@importacion');
Route::post('vehiculos/import/',					'VehiculoController@importacion');
Route::post('saluds/import/',						'SaludController@importacion');
Route::post('derrames/import/',						'DerrameController@importacion');
Route::post('users/import/',						'UserController@importacion');
Route::get('cie10/importar',						'CieController@importar');
Route::get('vehiculos/importar',					'VehiculoController@importar');
Route::get('fugas/importar',						'FugaController@importar');
Route::get('incendios/importar',					'IncendioController@importar');
Route::get('inundacions/importar',					'InundacionController@importar');
Route::get('rescates/importar',						'RescateController@importar');
Route::get('transitos/importar',					'TransitoController@importar');
Route::get('saluds/importar',						'SaludController@importar');
Route::get('derrames/importar',						'DerrameController@importar');
Route::get('users/importar',						'UserController@importar');

//Rutas Permisos Usuarios 
Route::get('users/permisosxrol/{id}',				'UserController@PerrmisosxRol');
Route::get('users/consultarol/{id}',				'UserController@ConsultaRolUsuario')->name('consultrol');
Route::get('users/roles',							'UserController@rol');
Route::get('profile/edit/{id}',   					'UserController@edit')->name('profile.edit');
Route::put('users/changerol',						'UserController@CambiaRoldeUsuario')->name('changerol');
Route::put('users/cambiapermisosarol/',				'UserController@CambiaPermisosRol')->name('changepermissions');

//Rutas para realizar Exportacion  de informacion a Excel
Route::get('incidentes/export/', 					'IncidenteController@export');
Route::get('vehiculos/export/',    					'VehiculoController@export');
Route::get('claves/export/',     					'ClaveController@export');
Route::get('stations/export/',   					'StationController@export');
Route::get('parroquias/export/', 					'ParroquiaController@export');
Route::get('inundacions/export/', 					'InundacionController@export');
Route::get('transitos/export/', 					'TransitoController@export');
Route::get('rescates/export/',    					'RescateController@export');
Route::get('incendios/export',   					'IncendioController@export');
Route::get('fugas/export',   						'FugaController@export');
Route::get('saluds/export',   						'SaludController@export');
Route::get('derrames/export',   					'DerrameController@export');
Route::get('servicios/export',   					'ServicioController@export');
Route::get('prevencion/export',   					'MovilizacionController@export');
Route::get('estadisticas/export/{id},{f1},{f2}', 	'ConsultasController@export');
Route::get('estadisticas/export2/{id},{f1},{f2}', 	'ConsultasController@export2');

//Rutas Creacion de Raporte Grafico
Route::get('vehiculos/grafic/',						'VehiculoController@grafica');
Route::get('inundacions/grafic/',					'InundacionController@grafica');
Route::get('transitos/grafic/',   					'TransitoController@grafica');
Route::get('incendios/grafic/',   					'IncendioController@grafica');
Route::get('rescates/grafic/',   					'RescateController@grafica');
Route::get('claves/grafic/',     					'ClaveController@grafica');
Route::get('saluds/grafic/',     					'SaludController@grafica');
Route::get('fugas/grafic/',     					'FugaController@grafica');
Route::get('derrames/grafic/',     					'DerrameController@grafica');
Route::get('servicios/grafic/',    					'ServicioController@grafica');
Route::get('prevencion/grafic/',    				'MovilizacionController@grafica');

//Rutas Creacion de Reportes en Formato PDF
Route::get('/downloadPDFinundacion/{id}',			'InundacionController@downloadPDF')->middleware('auth');;
Route::get('/downloadPDFrescate/{id}',				'RescateController@downloadPDF')->middleware('auth');
Route::get('/downloadPDFtransito/{id}',				'TransitoController@downloadPDF')->middleware('auth');
Route::get('/downloadPDFsalud/{id}',				'SaludController@downloadPDF')->middleware('auth');
Route::get('/downloadPDFincendio/{id}',				'IncendioController@downloadPDF')->middleware('auth');
Route::get('/downloadPDFfuga/{id}',					'FugaController@downloadPDF')->middleware('auth');
Route::get('/downloadPDFclave/{id}',				'ClaveController@downloadPDF')->middleware('auth');
Route::get('/downloadPDFservicio/{id}',				'ServicioController@downloadPDF')->middleware('auth');
Route::get('/downloadPDFmovilizacion/{id}', 		'MovilizacionController@downloadPDF')->middleware('auth');
Route::get('/downloadPDFderrame/{id}',				'DerrameController@downloadPDF')->middleware('auth');

//Rutas Creacion de Reportes a Mail
Route::get('/sendReportInundacion/{id}',			'MailController@SendMailsInundacion')->middleware('auth');
Route::get('/sendReportRescate/{id}',				'MailController@SendMailsRescate')->middleware('auth');
Route::get('/sendReportTransito/{id}',				'MailController@SendMailsTransito')->middleware('auth');
Route::get('/sendReportSalud/{id}',					'MailController@SendMailsSalud')->middleware('auth');
Route::get('/sendReportIncendio/{id}',				'MailController@SendMailsIncendio')->middleware('auth');
Route::get('/sendReportFuga/{id}',					'MailController@SendMailsFuga')->middleware('auth');
Route::get('/sendReportClave/{id}',					'MailController@SendMailsClave')->middleware('auth');
Route::get('/sendReportDerrame/{id}',				'MailController@SendMailsDerrame')->middleware('auth');
Route::get('/sendReportServicio/{id}',				'MailController@SendMailsServicio')->middleware('auth');
Route::get('/sendReportMovilizacion/{id}',			'MailController@SendMailsMovilizacion')->middleware('auth');
Route::get('/sendReportPrevencion/{id}',			'MailController@SendMailsPrevencion')->middleware('auth');

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

Route::get('profile/perfil', 						'ProfileController@index')->name('profile.index')->middleware('auth');
Route::put('profile/perfil', 						'ProfileController@update')->name('profile.update')->middleware('auth');
Route::put('profile/pass', 							'ProfileController@pass')->name('profile.pass')->middleware('auth');
Route::put('profile/avatar', 						'ProfileController@update_avatar')->name('profile.avatar')->middleware('auth');

