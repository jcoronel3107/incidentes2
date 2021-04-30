<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Clave;
use App\Inundacion;
use App\Incendio;
use App\Transito;
use App\Salud;
use App\Rescate;
use App\Fuga;
use App\Derrame;
use App\Servicio;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /* public function __construct()
    {
        $this->middleware('auth');
    } */
    
    public function index()
    {
       return view("welcome");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view("consultas");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
	
	public function estadisticas()
    {
        return view("estadisticas");
    }
	
	public function reportar()
    {
        return view("reportar");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function evento()
    {
        
        
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $fechaComoEntero = strtotime($date);
        $mes = date("m", $fechaComoEntero);

       

        $SaludEst = Salud::whereMonth('fecha', $mes)
                                                ->where('station_id','=','1')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('saluds.deleted_at')
                                                ->get()->count();


        $InundacionEst= Inundacion::whereMonth('fecha', $mes)
                                                ->where('station_id','=','1')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('inundacions.deleted_at')
                                                ->get()->count();


        $FuegoEst = Incendio::whereMonth('fecha', $mes)
                                                ->where('station_id','=','1')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('incendios.deleted_at')
                                                ->get()->count();

        $HazmatEst = Derrame::whereMonth('fecha', $mes)
                                                ->where('station_id','=','1')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('derrames.deleted_at')
                                                ->get()->count();

        $TransitoEst= Transito::whereMonth('fecha', $mes)
                                                ->where('station_id','=','1')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('transitos.deleted_at')
                                                ->get()->count();

        $RescateEst = Rescate::whereMonth('fecha', $mes)
                                                ->where('station_id','=','1')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('rescates.deleted_at')
                                                ->get()->count();
        
        $FugaEst = Fuga::whereMonth('fecha', $mes)
                                                ->where('station_id','=','1')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('fugas.deleted_at')
                                                ->get()->count();

        $mensualesInundacion="";
        $station = trans('messages.Station1');
        $estacion_id="1";
        return view("evento", compact(  "mensualesInundacion","SaludEst","InundacionEst","FuegoEst","HazmatEst","TransitoEst","RescateEst","FugaEst","station","date", "estacion_id") );
    }

    public function evento2()
    {
        
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $fechaComoEntero = strtotime($date);
        $mes = date("m", $fechaComoEntero);

       
      
             
        $SaludEst = Salud::whereMonth('fecha', $mes)
                                                ->where('station_id','=','2')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('saluds.deleted_at')
                                                ->get()->count();


        $InundacionEst= Inundacion::whereMonth('fecha', $mes)
                                                ->where('station_id','=','2')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('inundacions.deleted_at')
                                                ->get()->count();


        $FuegoEst = Incendio::whereMonth('fecha', $mes)
                                                ->where('station_id','=','2')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('incendios.deleted_at')
                                                ->get()->count();

        $HazmatEst = Derrame::whereMonth('fecha', $mes)
                                                ->where('station_id','=','2')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('derrames.deleted_at')
                                                ->get()->count();

        $TransitoEst = Transito::whereMonth('fecha', $mes)
                                                ->where('station_id','=','2')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('transitos.deleted_at')
                                                ->get()->count();

        $RescateEst = Rescate::whereMonth('fecha', $mes)
                                                ->where('station_id','=','2')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('rescates.deleted_at')
                                                ->get()->count();
        
        $FugaEst = Fuga::whereMonth('fecha', $mes)
                                                ->where('station_id','=','2')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('fugas.deleted_at')
                                                ->get()->count();
        $mensualesInundacion="";
        $estacion_id = "2";
        $station = trans('messages.Station2');
        if(view()->exists('evento'))
        {
            return view("evento", compact( "mensualesInundacion","SaludEst","InundacionEst","FuegoEst","HazmatEst","TransitoEst","RescateEst","FugaEst","station","date", "estacion_id") );
        }

        
    }

    public function evento3()
    {
        

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $fechaComoEntero = strtotime($date);
        $mes = date("m", $fechaComoEntero);

        
        $SaludEst = Salud::whereMonth('fecha', $mes)
                                                ->where('station_id','=','3')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('saluds.deleted_at')
                                                ->get()->count();


        $InundacionEst= Inundacion::whereMonth('fecha', $mes)
                                                ->where('station_id','=','3')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('inundacions.deleted_at')
                                                ->get()->count();


        $FuegoEst = Incendio::whereMonth('fecha', $mes)
                                                ->where('station_id','=','3')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('incendios.deleted_at')
                                                ->get()->count();

        $HazmatEst = Derrame::whereMonth('fecha', $mes)
                                                ->where('station_id','=','3')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('derrames.deleted_at')
                                                ->get()->count();

        $TransitoEst= Transito::whereMonth('fecha', $mes)
                                                ->where('station_id','=','3')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('transitos.deleted_at')
                                                ->get()->count();

        $RescateEst = Rescate::whereMonth('fecha', $mes)
                                                ->where('station_id','=','3')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('rescates.deleted_at')
                                                ->get()->count();
        
        $FugaEst = Fuga::whereMonth('fecha', $mes)
                                                ->where('station_id','=','3')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('fugas.deleted_at')
                                                ->get()->count();
        $mensualesInundacion="";
        $station = trans('messages.Station3');
        $estacion_id = "3";
        return view("evento", compact(  "mensualesInundacion","SaludEst","InundacionEst","FuegoEst","HazmatEst","TransitoEst","RescateEst","FugaEst","station","date", "estacion_id") );
    }
    public function evento4()
    {
        

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $fechaComoEntero = strtotime($date);
        $mes = date("m", $fechaComoEntero);

       
        $SaludEst = Salud::whereMonth('fecha', $mes)
                                                ->where('station_id','=','4')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('saluds.deleted_at')
                                                ->get()->count();


        $InundacionEst= Inundacion::whereMonth('fecha', $mes)
                                                ->where('station_id','=','4')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('inundacions.deleted_at')
                                                ->get()->count();


        $FuegoEst = Incendio::whereMonth('fecha', $mes)
                                                ->where('station_id','=','4')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('incendios.deleted_at')
                                                ->get()->count();

        $HazmatEst = Derrame::whereMonth('fecha', $mes)
                                                ->where('station_id','=','4')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('derrames.deleted_at')
                                                ->get()->count();

        $TransitoEst= Transito::whereMonth('fecha', $mes)
                                                ->where('station_id','=','4')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('transitos.deleted_at')
                                                ->get()->count();

        $RescateEst = Rescate::whereMonth('fecha', $mes)
                                                ->where('station_id','=','4')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('rescates.deleted_at')
                                                ->get()->count();
        
        $FugaEst = Fuga::whereMonth('fecha', $mes)
                                                ->where('station_id','=','4')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('fugas.deleted_at')
                                                ->get()->count();
        $mensualesInundacion="";
        $station = trans('messages.Station4');
        $estacion_id = "4";
        return view("evento", compact(  "mensualesInundacion","SaludEst","InundacionEst","FuegoEst","HazmatEst","TransitoEst","RescateEst","FugaEst","station","date", "estacion_id") );
    }
    public function evento5()
    {
       
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $fechaComoEntero = strtotime($date);
        $mes = date("m", $fechaComoEntero);

       
        $SaludEst = Salud::whereMonth('fecha', $mes)
                                                ->where('station_id','=','5')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('saluds.deleted_at')
                                                ->get()->count();


        $InundacionEst= Inundacion::whereMonth('fecha', $mes)
                                                ->where('station_id','=','5')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('inundacions.deleted_at')
                                                ->get()->count();


        $FuegoEst = Incendio::whereMonth('fecha', $mes)
                                                ->where('station_id','=','5')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('incendios.deleted_at')
                                                ->get()->count();

        $HazmatEst = Derrame::whereMonth('fecha', $mes)
                                                ->where('station_id','=','5')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('derrames.deleted_at')
                                                ->get()->count();

        $TransitoEst= Transito::whereMonth('fecha', $mes)
                                                ->where('station_id','=','5')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('transitos.deleted_at')
                                                ->get()->count();

        $RescateEst = Rescate::whereMonth('fecha', $mes)
                                                ->where('station_id','=','5')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('rescates.deleted_at')
                                                ->get()->count();
        
        $FugaEst = Fuga::whereMonth('fecha', $mes)
                                                ->where('station_id','=','5')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('fugas.deleted_at')
                                                ->get()->count();
        $mensualesInundacion="";
        $station = trans('messages.Station5');
        $estacion_id = "5";
        return view("evento", compact(  "mensualesInundacion","SaludEst","InundacionEst","FuegoEst","HazmatEst","TransitoEst","RescateEst","FugaEst","station","date", "estacion_id") );
    }
    public function evento6()
    {
        

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $fechaComoEntero = strtotime($date);
        $mes = date("m", $fechaComoEntero);
        
       
        $SaludEst = Salud::whereMonth('fecha', $mes)
                                                ->where('station_id','=','6')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('saluds.deleted_at')
                                                ->get()->count();


        $InundacionEst= Inundacion::whereMonth('fecha', $mes)
                                                ->where('station_id','=','6')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('inundacions.deleted_at')
                                                ->get()->count();


        $FuegoEst = Incendio::whereMonth('fecha', $mes)
                                                ->where('station_id','=','6')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('incendios.deleted_at')
                                                ->get()->count();

        $HazmatEst = Derrame::whereMonth('fecha', $mes)
                                                ->where('station_id','=','6')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('derrames.deleted_at')
                                                ->get()->count();

        $TransitoEst= Transito::whereMonth('fecha', $mes)
                                                ->where('station_id','=','6')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('transitos.deleted_at')
                                                ->get()->count();

        $RescateEst = Rescate::whereMonth('fecha', $mes)
                                                ->where('station_id','=','6')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('rescates.deleted_at')
                                                ->get()->count();
        
        $FugaEst = Fuga::whereMonth('fecha', $mes)
                                                ->where('station_id','=','6')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('fugas.deleted_at')
                                                ->get()->count();
        $mensualesInundacion="";
        $station = trans('messages.Station6');
        $estacion_id = "6";
        return view("evento", compact(  "mensualesInundacion","SaludEst","InundacionEst","FuegoEst","HazmatEst","TransitoEst","RescateEst","FugaEst","station","date", "estacion_id") );
    }
    public function evento7()
    {
        

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $fechaComoEntero = strtotime($date);
        $mes = date("m", $fechaComoEntero);

      
          
        $SaludEst = Salud::whereMonth('fecha', $mes)
                                                ->where('station_id','=','7')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('saluds.deleted_at')
                                                ->get()->count();


        $InundacionEst= Inundacion::whereMonth('fecha', $mes)
                                                ->where('station_id','=','7')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('inundacions.deleted_at')
                                                ->get()->count();


        $FuegoEst = Incendio::whereMonth('fecha', $mes)
                                                ->where('station_id','=','7')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('incendios.deleted_at')
                                                ->get()->count();

        $HazmatEst = Derrame::whereMonth('fecha', $mes)
                                                ->where('station_id','=','7')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('derrames.deleted_at')
                                                ->get()->count();

        $TransitoEst= Transito::whereMonth('fecha', $mes)
                                                ->where('station_id','=','7')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('transitos.deleted_at')
                                                ->get()->count();

        $RescateEst = Rescate::whereMonth('fecha', $mes)
                                                ->where('station_id','=','7')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('rescates.deleted_at')
                                                ->get()->count();
        
        $FugaEst = Fuga::whereMonth('fecha', $mes)
                                                ->where('station_id','=','7')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('fugas.deleted_at')
                                                ->get()->count();
        $mensualesInundacion="";
        $station = trans('messages.Station7');
        $estacion_id = "7";
        return view("evento", compact(  "mensualesInundacion","SaludEst","InundacionEst","FuegoEst","HazmatEst","TransitoEst","RescateEst","FugaEst","station","date", "estacion_id") );
    }
    public function evento8()
    {
        

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $fechaComoEntero = strtotime($date);
        $mes = date("m", $fechaComoEntero);

       
        $SaludEst = Salud::whereMonth('fecha', $mes)
                                                ->where('station_id','=','8')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('saluds.deleted_at')
                                                ->get()->count();


        $InundacionEst= Inundacion::whereMonth('fecha', $mes)
                                                ->where('station_id','=','8')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('inundacions.deleted_at')
                                                ->get()->count();


        $FuegoEst = Incendio::whereMonth('fecha', $mes)
                                                ->where('station_id','=','8')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('incendios.deleted_at')
                                                ->get()->count();

        $HazmatEst = Derrame::whereMonth('fecha', $mes)
                                                ->where('station_id','=','8')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('derrames.deleted_at')
                                                ->get()->count();

        $TransitoEst= Transito::whereMonth('fecha', $mes)
                                                ->where('station_id','=','8')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('transitos.deleted_at')
                                                ->get()->count();

        $RescateEst = Rescate::whereMonth('fecha', $mes)
                                                ->where('station_id','=','8')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('rescates.deleted_at')
                                                ->get()->count();
        
        $FugaEst = Fuga::whereMonth('fecha', $mes)
                                                ->where('station_id','=','8')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('fugas.deleted_at')
                                                ->get()->count();
        $mensualesInundacion="";
        $station = trans('messages.Station8');
        $estacion_id = "8";
        return view("evento", compact( "mensualesInundacion","SaludEst","InundacionEst","FuegoEst","HazmatEst","TransitoEst","RescateEst","FugaEst","station","date", "estacion_id") );
    }
    public function evento9()
    {
        

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $fechaComoEntero = strtotime($date);
        $mes = date("m", $fechaComoEntero);

        
        $SaludEst = Salud::whereMonth('fecha', $mes)
                                                ->where('station_id','=','9')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('saluds.deleted_at')
                                                ->get()->count();


        $InundacionEst= Inundacion::whereMonth('fecha', $mes)
                                                ->where('station_id','=','9')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('inundacions.deleted_at')
                                                ->get()->count();


        $FuegoEst = Incendio::whereMonth('fecha', $mes)
                                                ->where('station_id','=','9')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('incendios.deleted_at')
                                                ->get()->count();

        $HazmatEst = Derrame::whereMonth('fecha', $mes)
                                                ->where('station_id','=','9')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('derrames.deleted_at')
                                                ->get()->count();

        $TransitoEst= Transito::whereMonth('fecha', $mes)
                                                ->where('station_id','=','9')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('transitos.deleted_at')
                                                ->get()->count();

        $RescateEst = Rescate::whereMonth('fecha', $mes)
                                                ->where('station_id','=','9')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('rescates.deleted_at')
                                                ->get()->count();
        
        $FugaEst = Fuga::whereMonth('fecha', $mes)
                                                ->where('station_id','=','9')
                                                ->whereYear('fecha', '=', date('Y'))
                                                ->whereNull('fugas.deleted_at')
                                                ->get()->count();
        $mensualesInundacion="";
        $station = trans('messages.Station9');
        $estacion_id = "9";
        return view("evento", compact( "mensualesInundacion","SaludEst","InundacionEst","FuegoEst","HazmatEst","TransitoEst","RescateEst","FugaEst","station","date", "estacion_id") );
    }

    public function refrescamiento()
    {

         /* $date = Carbon::now();
        $lifetime = config('session.lifetime');
        $date->toDateTimeString();  
        $endDate = $date->subHour($lifetime);
        $timestamp = $date->getTimestamp();
        $loggedin_instances = DB::table('sessions')
        ->where('user_id', Auth::user()->id)
        ->where('last_activity','>', $timestamp) //This condition is needed only if lifetime is set and expire_on_close is false;
        ->get(); */
        $user = Auth::user();
        
            $user = Auth::user();
            $last_activity = DB::table('sessions')
            ->select('last_activity')
            ->where('user_id', $user->id)
            ->get();
        $last_activity = Carbon::createFromTimestamp($last_activity);
        
        $horaactual = Carbon::now()->toTimeString();
        $last_activity->diffInMinutes($horaactual);
        //dd($last_activity->diffForHumans());
        $last_activity = $last_activity->diffForHumans();      
         return $last_activity;
    }

    public function qrcode_blade()
    {
       
            return QrCode::size(150)
                ->backgroundColor(205, 205, 204)
                ->generate('MyNotePaper');
    }
}
