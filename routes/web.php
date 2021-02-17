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
Route::get('/',                  	'PagesController@index');
Auth::routes();
Route::get('lang/{lang}', 			'LanguageController@swap')->name('lang.swap');
Route::resource('clave',         	'ClaveController');
Route::resource('incidente',     	'IncidenteController');
Route::resource('inundacion',    	'InundacionController');
Route::resource('gasolinera',    	'GasolineraController');
Route::resource('vehiculo',      	'VehiculoController');
Route::resource('estacion',      	'StationController');
Route::resource('parroquia',     	'ParroquiaController');
Route::resource('fuego',         	'IncendioController');
Route::resource('fuga',     	 	'FugaController');
Route::resource('rescate',       	'RescateController');
Route::resource('transito',      	'TransitoController');
Route::resource('salud',     	 	'SaludController');
Route::resource('derrame',     	 	'DerrameController');
Route::resource('servicio',    	 	'ServicioController');
Route::resource('consulta',      	'ConsultasController');

Route::get('/activitylog',			'ConsultasController@activitylog');
Route::get('/consultaentrefechas',	'ConsultasController@consultaentrefechas');
Route::get('/busquedaentrefechas',	'ConsultasController@busquedaentrefechas');

Route::get('/download/{file}', 		'DownloadsController@download');


Route::get('/inundacions/carga/{id}','InundacionController@cargar');
Route::get('/derrames/carga/{id}',	'DerrameController@cargar');
Route::get('/incendios/carga/{id}',	'IncendioController@cargar');
Route::get('/rescates/carga/{id}',	'RescateController@cargar');
Route::get('/transitos/carga/{id}',	'TransitoController@cargar');
Route::get('/saluds/carga/{id}',	'SaludController@cargar');
Route::get('/fugas/carga/{id}',		'FugaController@cargar');

Route::post('inundacions/guardaform','InundacionController@upload');
Route::post('derrames/guardaform',	'DerrameController@upload');
Route::post('incendios/guardaform',	'IncendioController@upload');
Route::post('rescates/guardaform',	'RescateController@upload');
Route::post('transitos/guardaform',	'TransitoController@upload');
Route::post('saluds/guardaform',	'SaludController@upload');
Route::post('fugas/guardaform',		'FugaController@upload');

Route::post('cie10/import/',		'CieController@importacion');
Route::post('inundacions/import/',	'InundacionController@importacion');
Route::post('rescates/import/',		'RescateController@importacion');
Route::post('transitos/import/',	'TransitoController@importacion');
Route::post('incendios/import/',	'IncendioController@importacion');
Route::post('fugas/import/',		'FugaController@importacion');
Route::post('vehiculos/import/',	'VehiculoController@importacion');
Route::post('saluds/import/',		'SaludController@importacion');
Route::post('derrames/import/',		'DerrameController@importacion');
Route::post('users/import/',		'UserController@importacion');

Route::get('cie10/importar',		'CieController@importar');
Route::get('vehiculos/importar',	'VehiculoController@importar');
Route::get('fugas/importar',		'FugaController@importar');
Route::get('incendios/importar',	'IncendioController@importar');
Route::get('inundacions/importar',	'InundacionController@importar');
Route::get('rescates/importar',		'RescateController@importar');
Route::get('transitos/importar',	'TransitoController@importar');
Route::get('saluds/importar',		'SaludController@importar');
Route::get('derrames/importar',		'derrameController@importar');
Route::get('users/importar',		'UserController@importar');

Route::get('incidentes/export/', 	'IncidenteController@export');
Route::get('vehiculos/export/',    	'VehiculoController@export');
Route::get('claves/export/',     	'ClaveController@export');
Route::get('stations/export/',   	'StationController@export');
Route::get('parroquias/export/', 	'ParroquiaController@export');
Route::get('inundacions/export/', 	'InundacionController@export');
Route::get('transitos/export/', 	'TransitoController@export');
Route::get('rescates/export/',    	'RescateController@export');
Route::get('incendios/export',   	'IncendioController@export');
Route::get('fugas/export',   		'FugaController@export');
Route::get('saluds/export',   		'SaludController@export');
Route::get('derrames/export',   	'DerrameController@export');

//Rutas Creacion de Raporte Grafico
Route::get('vehiculos/grafic/',		'VehiculoController@grafica');
Route::get('inundacions/grafic/',	'InundacionController@grafica');
Route::get('transitos/grafic/',   	'TransitoController@grafica');
Route::get('incendios/grafic/',   	'IncendioController@grafica');
Route::get('rescates/grafic/',   	'RescateController@grafica');
Route::get('claves/grafic/',     	'ClaveController@grafica');
Route::get('saluds/grafic/',     	'SaludController@grafica');
Route::get('fugas/grafic/',     	'FugaController@grafica');
Route::get('derrames/grafic/',     	'DerrameController@grafica');
Route::get('servicios/grafic/',    	'ServicioController@grafica');

//Rutas Creacion de Reportes en Formato PDF
Route::get('/downloadPDFinundacion/{id}',		'InundacionController@downloadPDF');
Route::get('/downloadPDFrescate/{id}',			'RescateController@downloadPDF');
Route::get('/downloadPDFtransito/{id}',			'TransitoController@downloadPDF');
Route::get('/downloadPDFsalud/{id}',			'SaludController@downloadPDF');
Route::get('/downloadPDFincendio/{id}',			'IncendioController@downloadPDF');
Route::get('/downloadPDFfuga/{id}',				'FugaController@downloadPDF');
Route::get('/downloadPDFclave/{id}',			'ClaveController@downloadPDF');
Route::get('/downloadPDFservicio/{id}',			'ServicioController@downloadPDF');
Route::get('/downloadPDFderrame/{id}',			'DerrameController@downloadPDF');

//Rutas Creacion de Reportes a Mail
Route::get('/sendReportInundacion/{id}','MailController@SendMailsInundacion');
Route::get('/sendReportRescate/{id}',	'MailController@SendMailsRescate');
Route::get('/sendReportTransito/{id}',	'MailController@SendMailsTransito');
Route::get('/sendReportSalud/{id}',		'MailController@SendMailsSalud');
Route::get('/sendReportIncendio/{id}',	'MailController@SendMailsIncendio');
Route::get('/sendReportFuga/{id}',		'MailController@SendMailsFuga');
Route::get('/sendReportClave/{id}',		'MailController@SendMailsClave');
Route::get('/sendReportDerrame/{id}',	'MailController@SendMailsDerrame');
Route::get('/sendReportServicio/{id}',	'MailController@SendMailsServicio');
Route::get('/prueba1/',					'ConsultasController@EventosxIncidente');
Route::get('/eventoE1/',				'MenuController@evento');
Route::get('/eventoE2/',				'MenuController@evento2');
Route::get('/eventoE3/',				'MenuController@evento3');
Route::get('/eventoE4/',				'MenuController@evento4');
Route::get('/eventoE5/',				'MenuController@evento5');
Route::get('/eventoE6/',				'MenuController@evento6');
Route::get('/eventoE7/',				'MenuController@evento7');
Route::get('/eventoE8/',				'MenuController@evento8');
Route::get('/eventoE9/',				'MenuController@evento9');



Route::get('/home',              'HomeController@index');
Route::get('/admin',             'AdministradorController@index');
/*Route::get('/admin/user/rols',['middleware'=>'rol',function(){
	return "Middleware rol";
}]);*/
Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function(){
  Route::get('/perfil', 'ProfileController@index')->name('profile.index');
  Route::put('/perfil', 'ProfileController@update')->name('profile.update');
  Route::put('/pass', 'ProfileController@pass')->name('profile.pass');
  Route::put('/avatar', 'ProfileController@update_avatar')->name('profile.avatar');
});// /group prefix=>profile

Route::get('/mail', function () {
	//return view('welcome');
	$datos=[
		"titulo"=>"Hola prueba de correo Sistema Incidentes2",
		"contenido"=>"Esto es una prueba de envio"
	];

	Mail::send("mails.test",$datos,function($mensaje){
		$mensaje->to("jcoronel@bomberos.gob.ec","Sistema Incidentes2")->subject("Ojo,mensaje importante");
	});

});

//Route::get('/prueba','ConsultaController@EventosxIncidente');
Route::get('/prueba', function () {


	$mensualesInundacion= Inundacion::select(DB::raw("Month(fecha) as Mes, 'inundacion' ,count(*) as count"))
		->whereYear('fecha',date('Y'))
		->groupBy('Mes')
		->get();
	
	$mensualesRescate= Rescate::select(DB::raw("Month(fecha) as Mes, 'Rescate',count(*) as count"))
		->whereYear('fecha',date('Y'))
		->groupBy('Mes')
		->get();
	
	$mensualesTransito= Transito::select(DB::raw("Month(fecha) as Mes, 'Transito',count(*) as count"))
		->whereYear('fecha',date('Y'))
		->groupBy(\DB::raw("Month(fecha)"))
		->get();
	$mensualesSalud= Salud::select(DB::raw("Month(fecha) as Mes, 
		'Salud',count(*) as count"))
		->whereYear('fecha',date('Y'))
		->groupBy(\DB::raw("Month(fecha)"))
		->get();
	$mensualesFuego= Incendio::select(DB::raw("Month(fecha) as Mes, 'Incendio',count(*) as count"))	
		->whereYear('fecha',date('Y'))
		->groupBy(DB::raw("Month(fecha)"))
		->get();
	$mensualesGas= Fuga::select(DB::raw("Month(fecha) as Mes, 
		'Fuga',count(*) as count"))	
		->whereYear('fecha',date('Y'))
		->groupBy(DB::raw("Month(fecha)"))
		->get();
	$mensualesDerrames= Derrame::select(DB::raw("Month(fecha) as Mes, 'Derrame',count(*) as count"))
		->whereYear('fecha',date('Y'))
		->groupBy(DB::raw("Month(fecha)"))
		->get();
	$EventosMensuales = $mensualesInundacion->merge($mensualesRescate);
	$EventosMensuales = $EventosMensuales->merge($mensualesTransito);
	$EventosMensuales = $EventosMensuales->merge($mensualesSalud);
	/*$EventosMensuales = $EventosMensuales->merge($mensualesFuego);
	$EventosMensuales = $EventosMensuales->merge($mensualesGas);
	$EventosMensuales = $EventosMensuales->merge($mensualesDerrames);*/
		//dd($mensualesRescate);
	return $mensualesRescate;
});

Route::get('/prueba2',function()
	{
		$Inundacionxestacion = Claves::select( DB::raw('count(station_id) salidas'))
                ->where('station_id','=','5')
                ->whereYear('fecha', '=', date('Y'))
                ->whereNull('saluds.deleted_at')
                ->groupBy('station_id')
                ->havingRaw('count(station_id) >= ?',[1])
                ->get();
			return $Inundacionxestacion;
	});

Route::get('/prueba3',function()
	{
		$Inundacionxestacion = DB::table('claves')
				->join('gasolineras', 'claves.gasolinera_id', '=', 'gasolineras.id')
                ->select('gasolinera_id','gasolineras.razonsocial', DB::raw('count(gasolinera_id) Nro_Cargas'))
                ->whereYear('claves.created_at', '=', date('Y'))
                ->whereNull('claves.deleted_at')
                ->groupBy('claves.gasolinera_id')
                ->havingRaw('count(claves.gasolinera_id) >= ?',[1])
                ->get();
			return $Inundacionxestacion;
	});
