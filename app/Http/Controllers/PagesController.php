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

        $mensualesDerramesGraph= DB::table('derrames')->select(DB::raw("'derrames' as Incidentes,Month(fecha) as Mes,count(*) as cant"))
				->whereYear('fecha',date('Y'))
				->whereNull('derrames.deleted_at')
				->groupBy(DB::raw("Month(fecha)"))
				->get();

	  	$mensualesGasGraph= DB::table('fugas')->select(DB::raw("'fugas' as Incidentes,Month(fecha) as Mes,count(*) as cant"))
				->whereYear('fecha',date('Y'))
				->whereNull('fugas.deleted_at')
				->groupBy(DB::raw("Month(fecha)"))
				->get();
      $mensualesFuegoGraph= DB::table('incendios')->select(DB::raw("'incendios' as Incidentes,Month(fecha) as Mes,count(*) as cant"))
          ->whereYear('fecha',date('Y'))	
				->whereNull('incendios.deleted_at')
				->groupBy(DB::raw("Month(fecha)"))	
				->get();
      $mensualesSaludGraph= DB::table('saluds')->select(DB::raw("'saluds' as Incidentes,Month(fecha) as Mes,count(*) as cant"))
				->whereYear('fecha',date('Y'))	
				->whereNull('saluds.deleted_at')
				->groupBy(DB::raw("Month(fecha)"))	
				->get();

      $mensualesTransitoGraph= DB::table('transitos')->select(DB::raw("'transitos' as Incidentes,Month(fecha) as Mes,count(*) as cant"))
				->whereYear('fecha',date('Y'))
				->whereNull('transitos.deleted_at')	
				->groupBy(DB::raw("Month(fecha)"))
                ->get();
      $mensualesRescateGraph= DB::table('rescates')->select( DB::raw("'rescates' as Incidentes,Month(fecha) as Mes,count(*) as cant"))
				->whereYear('fecha',date('Y'))
				->whereNull('rescates.deleted_at')
				->groupBy(DB::raw("Month(fecha)"))
                ->get();
                
      $mensualesInundacionGraph= DB::table('inundacions')->select(DB::raw("'inundaciones' as Incidentes ,Month(fecha) as Mes,count(*) as cant"))
        		->whereYear('fecha',date('Y'))
        		->whereNull('inundacions.deleted_at')
        		->groupBy(DB::raw("Month(fecha)"))
        		->get();
      $EventosMensuales = $mensualesInundacionGraph->merge($mensualesRescateGraph);
      $EventosMensuales = $EventosMensuales->merge($mensualesTransitoGraph);
      $EventosMensuales = $EventosMensuales->merge($mensualesSaludGraph);
      $EventosMensuales = $EventosMensuales->merge($mensualesFuegoGraph);
      $EventosMensuales = $EventosMensuales->merge($mensualesGasGraph);
      $EventosMensuales = $EventosMensuales->merge($mensualesDerramesGraph);
      $EventosxIncidente = $mensualesInundacion+$mensualesRescate+$mensualesIncendio+$mensualesSalud+$mensualesTransito+$mensualesFuga+$mensualesDerrame;
     return view("welcome",compact("EventosMensuales","mensualesRescateGraph","EventosxIncidente","mensualesInundacion","mensualesRescate","mensualesIncendio","mensualesSalud","mensualesTransito","mensualesFuga","mensualesClave","mensualesServicio","mensualesDerrame"/* ,"loggedin_instances" */));	
    }

    public function dashboard(){
      return view('layouts.home');
    } 
}
