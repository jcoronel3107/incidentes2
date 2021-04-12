<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clave;
use App\Inundacion;
use App\Incendio;
use App\Transito;
use App\Salud;
use App\Rescate;
use App\Fuga;
use App\Derrame;
use App\Servicio;
use App\Http\Requests\CreateClaveRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
     public function __construct(){
        $this->middleware('auth');

    } 

    public function index()
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
    	

		$date = Carbon::now();
		$fechaComoEntero = strtotime($date);
		$mes = date("m", $fechaComoEntero);
 
    	$mensualesInundacion= Inundacion::whereMonth('fecha', $mes)
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('inundacions.deleted_at')
        ->get()->count();
        
        $mensualesRescate= Rescate::whereMonth('fecha', $mes)
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('rescates.deleted_at')
        ->get()->count();
        $mensualesIncendio= Incendio::whereMonth('fecha', $mes)
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('incendios.deleted_at')
        ->get()->count();
        $mensualesSalud= Salud::whereMonth('fecha', $mes)
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('saluds.deleted_at')
        ->get()->count();
        $mensualesTransito= Transito::whereMonth('fecha', $mes)
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('transitos.deleted_at')
        ->get()->count();
        $mensualesFuga= Fuga::whereMonth('fecha', $mes)
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('fugas.deleted_at')
        ->get()->count();
        $mensualesClave= Clave::whereMonth('created_at', $mes)
        ->whereYear('created_at', '=', date('Y'))
        ->whereNull('claves.deleted_at')
        ->get()->count();
        $mensualesServicio= Servicio::whereMonth('created_at', $mes)
        ->whereYear('created_at', '=', date('Y'))
        ->whereNull('servicios.deleted_at')
        ->get()->count();
        $mensualesDerrame= Derrame::whereMonth('fecha', $mes)
        ->whereYear('fecha', '=', date('Y'))
        ->whereNull('derrames.deleted_at')
        ->get()->count();
    	return view("welcome",compact("mensualesInundacion","mensualesRescate","mensualesIncendio","mensualesSalud","mensualesTransito","mensualesFuga","mensualesClave","mensualesServicio","mensualesDerrame"/* ,"loggedin_instances" */));
    }

    
}
