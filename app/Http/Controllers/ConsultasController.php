<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ Inundacion;
use App\ Clave;
use App\ Rescate;
use App\ Transito;
use App\ Salud;
use App\ Incendio;
use App\ Fuga;
use App\ Derrame;
use PDF;
use Spatie\Activitylog\Models\Activity;

use Illuminate\ Support\Carbon;

class ConsultasController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view("estadisticas");
    }

    public function activitylog()
    {
    	$lastActivity = Activity::all(); //returns the  logged activity
    	
    	return  $lastActivity;
    }

    public function index(Request $request)
    {
        if($request)
        {
        	$now = Carbon::now();

        	$mensualesInundacion= Inundacion::select(DB::raw("Month(fecha) as Mes,count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(\DB::raw("Month(fecha)"))->get();

			$Inundacionxestacion = DB::table('inundacions')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Inundacionxincidente = DB::table('inundacions')
				->join('incidentes', 'inundacions.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Inundacionxparroquia = DB::table('inundacions')
				->join('parroquias', 'inundacions.parroquia_id', '=', 'parroquias.id')
				->select('parroquias.nombre', DB::raw('count(inundacions.id) salidas'))
				->groupBy('parroquias.nombre')
				->havingRaw('count(inundacions.id) >= ?',[1])
				->get();

			$mensualesRescate= Rescate::select(DB::raw("Month(fecha) as Mes,count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(\DB::raw("Month(fecha)"))->get();

			$Rescatexestacion = DB::table('rescates')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				/*->pluck('salidas','station_id');*/
				->get();

			$Rescatexincidente = DB::table('rescates')
				->join('incidentes', 'rescates.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				/*->pluck('salidas','station_id');*/
				->get();

			$mensualesTransito= Transito::select(DB::raw("Month(fecha) as Mes,count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(\DB::raw("Month(fecha)"))->get();
			$Transitoxestacion = DB::table('transitos')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				/*->pluck('salidas','station_id');*/
				->get();

			$Transitoxincidente = DB::table('transitos')
				->join('incidentes', 'transitos.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$mensualesSalud= Salud::select(DB::raw("Month(fecha) as Mes,count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(\DB::raw("Month(fecha)"))->get();

			$Saludxestacion = DB::table('saluds')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Saludxincidente = DB::table('saluds')
				->join('incidentes', 'saluds.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$mensualesFuego= Incendio::select(DB::raw("Month(fecha) as Mes,count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(DB::raw("Month(fecha)"))->get();

			$Fuegoxestacion = DB::table('incendios')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Fuegoxincidente = DB::table('incendios')
				->join('incidentes', 'incendios.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Incendiosxparroquia = DB::table('incendios')
				->join('parroquias', 'incendios.parroquia_id', '=', 'parroquias.id')
				->select('parroquias.nombre', DB::raw('count(incendios.id) salidas'))
				->groupBy('parroquias.nombre')
				->havingRaw('count(incendios.id) >= ?',[1])
				->get();

			$mensualesGas= Fuga::select(DB::raw("Month(fecha) as Mes,count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(DB::raw("Month(fecha)"))->get();

			$Gasxestacion = DB::table('fugas')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Gasxincidente = DB::table('fugas')
				->join('incidentes', 'fugas.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$mensualesDerrames= Derrame::select(DB::raw("Month(fecha) as Mes,count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(DB::raw("Month(fecha)"))->get();

			$Derramexestacion = DB::table('derrames')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Derramexincidente = DB::table('derrames')
				->join('incidentes', 'derrames.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$EventosxIncidente = $Inundacionxincidente->merge($Rescatexincidente);
			$EventosxIncidente = $EventosxIncidente->merge($Transitoxincidente);
			$EventosxIncidente = $EventosxIncidente->merge($Saludxincidente);
			$EventosxIncidente = $EventosxIncidente->merge($Fuegoxincidente);
			$EventosxIncidente = $EventosxIncidente->merge($Gasxincidente);
			$EventosxIncidente = $EventosxIncidente->merge($Derramexincidente);

			$EventosMensuales = $mensualesInundacion->merge($mensualesRescate);
			$EventosMensuales = $EventosMensuales->merge($mensualesTransito);
			$EventosMensuales = $EventosMensuales->merge($mensualesSalud);
			$EventosMensuales = $EventosMensuales->merge($mensualesFuego);
			$EventosMensuales = $EventosMensuales->merge($mensualesGas);
			$EventosMensuales = $EventosMensuales->merge($mensualesDerrames);

        	return view("/consulta.estadisticas",compact("mensualesInundacion","Inundacionxestacion","Inundacionxincidente","Inundacionxparroquia","mensualesRescate","Rescatexestacion","Rescatexincidente","mensualesTransito","Transitoxestacion","Transitoxincidente","mensualesSalud","Saludxestacion","Saludxincidente","mensualesFuego","Fuegoxestacion","Fuegoxincidente","Incendiosxparroquia","mensualesGas","Gasxestacion","Gasxincidente","now","EventosxIncidente","EventosMensuales"));
        }
    }









}
