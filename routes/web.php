<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IncidentesExport;
use App\Exports\StationsExport;
use App\Exports\InundacionsExport;
use App\Exports\TransitosExport;
use App\Inundacion;
use App\Rescate;
use App\Transito;
use App\Salud;
use App\Incendio;
use App\Fuga;
use App\Derrame;
use App\Mail\ReportSentInundacions;
use GuzzleHttp\Client;
use Spatie\Geocoder\Facades\Geocoder as GeocoderFacade;
use Spatie\Geocoder\Geocoder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
Route::resource('clave',							'ClaveController');
Route::resource('incidente',						'IncidenteController');
Route::resource('inundacion',						'InundacionController');
Route::resource('gasolinera',						'GasolineraController');
Route::resource('vehiculo',							'VehiculoController');
Route::resource('estacion',							'StationController');
Route::resource('parroquia',						'ParroquiaController');
Route::resource('fuego',							'IncendioController');
Route::resource('fuga',								'FugaController');
Route::resource('rescate',							'RescateController');
Route::resource('transito',							'TransitoController');
Route::resource('salud',							'SaludController');
Route::resource('derrame',							'DerrameController');
Route::resource('servicio',							'ServicioController');
Route::resource('consulta',							'ConsultasController');
Route::resource('user',								'UserController');

Route::get('/activitylog',							'ConsultasController@activitylog');
Route::get('/consultaentrefechas',					'ConsultasController@consultaentrefechas')->name('consultaentrefechas');
Route::get('/busquedaentrefechas',					'ConsultasController@busquedaentrefechas');

Route::get('/download/{file}', 						'DownloadsController@download');

//Rutas Carga Formularios Archivos PDF
Route::get('/inundacions/carga/{id}',				'InundacionController@cargar');
Route::get('/derrames/carga/{id}',					'DerrameController@cargar');
Route::get('/incendios/carga/{id}',					'IncendioController@cargar');
Route::get('/rescates/carga/{id}',					'RescateController@cargar');
Route::get('/transitos/carga/{id}',					'TransitoController@cargar');
Route::get('/saluds/carga/{id}',					'SaludController@cargar');
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
Route::get('estadisticas/export/{id},{f1},{f2}', 	'ConsultasController@export');

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

//Rutas Creacion de Reportes en Formato PDF
Route::get('/downloadPDFinundacion/{id}',			'InundacionController@downloadPDF');
Route::get('/downloadPDFrescate/{id}',				'RescateController@downloadPDF');
Route::get('/downloadPDFtransito/{id}',				'TransitoController@downloadPDF');
Route::get('/downloadPDFsalud/{id}',				'SaludController@downloadPDF');
Route::get('/downloadPDFincendio/{id}',				'IncendioController@downloadPDF');
Route::get('/downloadPDFfuga/{id}',					'FugaController@downloadPDF');
Route::get('/downloadPDFclave/{id}',				'ClaveController@downloadPDF');
Route::get('/downloadPDFservicio/{id}',				'ServicioController@downloadPDF');
Route::get('/downloadPDFderrame/{id}',				'DerrameController@downloadPDF');

//Rutas Creacion de Reportes a Mail
Route::get('/sendReportInundacion/{id}',			'MailController@SendMailsInundacion');
Route::get('/sendReportRescate/{id}',				'MailController@SendMailsRescate');
Route::get('/sendReportTransito/{id}',				'MailController@SendMailsTransito');
Route::get('/sendReportSalud/{id}',					'MailController@SendMailsSalud');
Route::get('/sendReportIncendio/{id}',				'MailController@SendMailsIncendio');
Route::get('/sendReportFuga/{id}',					'MailController@SendMailsFuga');
Route::get('/sendReportClave/{id}',					'MailController@SendMailsClave');
Route::get('/sendReportDerrame/{id}',				'MailController@SendMailsDerrame');
Route::get('/sendReportServicio/{id}',				'MailController@SendMailsServicio');

Route::get('/eventoE1/',							'MenuController@evento');
Route::get('/eventoE2/',							'MenuController@evento2');
Route::get('/eventoE3/',							'MenuController@evento3');
Route::get('/eventoE4/',							'MenuController@evento4');
Route::get('/eventoE5/',							'MenuController@evento5');
Route::get('/eventoE6/',							'MenuController@evento6');
Route::get('/eventoE7/',							'MenuController@evento7');
Route::get('/eventoE8/',							'MenuController@evento8');
Route::get('/eventoE9/',							'MenuController@evento9');

Route::get('profile/perfil', 						'ProfileController@index')->name('profile.index');

Route::put('profile/perfil', 						'ProfileController@update')->name('profile.update');
Route::put('profile/pass', 							'ProfileController@pass')->name('profile.pass');
Route::put('profile/avatar', 						'ProfileController@update_avatar')->name('profile.avatar');