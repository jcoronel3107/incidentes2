<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Inundacion;
use App\Clave;
use App\Rescate;
use App\Transito;
use App\Salud;
use App\Incendio;
use App\Fuga;
use App\Derrame;
use App\Incidente;
use PDF;
use Spatie\Activitylog\Models\Activity;
use App\Exports\Evento_Entre_FechasExport;
use App\Exports\TiempoRespuesta_Entre_FechasExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Carbon;

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
    	$lastActivity = Activity::all()->last();//returns the  logged activity
    	
    	return  $lastActivity;
    }

    public function index(Request $request)
    {
        if($request)
        {
        	$now = Carbon::now();

        	/**************************************
        	*
        	*	Inundacion
        	*
        	*
        	***************************************/

        	$mensualesInundacion= Inundacion::select(DB::raw("Month(fecha) as Mes,count(*) as count,'inundacion'"))
        		->whereYear('fecha',date('Y'))
        		->whereNull('inundacions.deleted_at')
        		->groupBy(DB::raw("Month(fecha)"))
        		->get();

			$Inundacionxestacion = DB::table('inundacions')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('inundacions.deleted_at')
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Inundacionxincidente = DB::table('inundacions')
				->join('incidentes', 'inundacions.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('inundacions.deleted_at')
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Inundacionxparroquia = DB::table('inundacions')
				->join('parroquias', 'inundacions.parroquia_id', '=', 'parroquias.id')
				->select('parroquias.nombre', DB::raw('count(inundacions.id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('inundacions.deleted_at')
				->groupBy('parroquias.nombre')
				->havingRaw('count(inundacions.id) >= ?',[1])
				->get();

			/**************************************
        	*
        	*	Rescate
        	*
        	*
        	***************************************/

			$mensualesRescate= Rescate::select(DB::raw("Month(fecha) as Mes,count(*) as count"))
				->whereYear('fecha',date('Y'))
				->whereNull('rescates.deleted_at')
				->groupBy(DB::raw("Month(fecha)"))
				->get();

			$Rescatexestacion = DB::table('rescates')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('rescates.deleted_at')
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				/*->pluck('salidas','station_id');*/
				->get();

			$Rescatexincidente = DB::table('rescates')
				->join('incidentes', 'rescates.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('rescates.deleted_at')
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				/*->pluck('salidas','station_id');*/
				->get();

			/**************************************
        	*
        	*	Transito
        	*
        	*
        	***************************************/

			$mensualesTransito= Transito::select(DB::raw("Month(fecha) as Mes,count(*) as count"))
				->whereYear('fecha',date('Y'))
				->whereNull('transitos.deleted_at')	
				->groupBy(DB::raw("Month(fecha)"))	
				->get();
			
			$Transitoxestacion = DB::table('transitos')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('transitos.deleted_at')
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Transitoxincidente = DB::table('transitos')
				->join('incidentes', 'transitos.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('transitos.deleted_at')
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				->get();


			/**************************************
        	*
        	*	Salud
        	*
        	*
        	***************************************/

			$mensualesSalud= Salud::select(DB::raw("Month(fecha) as Mes,count(*) as count"))
				->whereYear('fecha',date('Y'))	
				->whereNull('saluds.deleted_at')
				->groupBy(DB::raw("Month(fecha)"))	
				->get();

			$Saludxestacion = DB::table('saluds')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('saluds.deleted_at')
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Saludxincidente = DB::table('saluds')
				->join('incidentes', 'saluds.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('saluds.deleted_at')
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			/**************************************
        	*
        	*	Fuego
        	*
        	*
        	***************************************/

			$mensualesFuego= Incendio::select(DB::raw("Month(fecha) as Mes,count(*) as count"))
				->whereYear('fecha',date('Y'))	
				->whereNull('incendios.deleted_at')
				->groupBy(DB::raw("Month(fecha)"))	
				->get();

			$Fuegoxestacion = DB::table('incendios')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('incendios.deleted_at')
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Fuegoxincidente = DB::table('incendios')
				->join('incidentes', 'incendios.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('incendios.deleted_at')
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Incendiosxparroquia = DB::table('incendios')
				->join('parroquias', 'incendios.parroquia_id', '=', 'parroquias.id')
				->select('parroquias.nombre', DB::raw('count(incendios.id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('incendios.deleted_at')
				->groupBy('parroquias.nombre')
				->havingRaw('count(incendios.id) >= ?',[1])
				->get();

			/**************************************
        	*
        	*	Fuga
        	*
        	*
        	***************************************/
			
			$mensualesGas= Fuga::select(DB::raw("Month(fecha) as Mes,count(*) as count"))
				->whereYear('fecha',date('Y'))
				->whereNull('fugas.deleted_at')
				->groupBy(DB::raw("Month(fecha)"))
				->get();

			$Gasxestacion = DB::table('fugas')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('fugas.deleted_at')
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Gasxincidente = DB::table('fugas')
				->join('incidentes', 'fugas.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('fugas.deleted_at')
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Gasxparroquia = DB::table('fugas')
				->join('parroquias', 'fugas.parroquia_id', '=', 'parroquias.id')
				->select('parroquias.nombre', DB::raw('count(fugas.id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('fugas.deleted_at')
				->groupBy('parroquias.nombre')
				->havingRaw('count(fugas.id) >= ?', [1])
				->get();
			
			$GasxTipoCilindro = DB::table('fugas')
				->join('incidentes', 'fugas.incidente_id', '=', 'incidentes.id')
				->select('tipo_cilindro', DB::raw('count(tipo_cilindro) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('fugas.deleted_at')
				->groupBy('tipo_cilindro')
				->get();

			$GasxColor = DB::table('fugas')
			->join('incidentes', 'fugas.incidente_id', '=', 'incidentes.id')
			->select('color_cilindro', DB::raw('count(color_cilindro) salidas'))
			->whereYear('fecha', '=', date('Y'))
			->whereNull('fugas.deleted_at')
			->groupBy('color_cilindro')
			->get();
			/**************************************
        	*
        	*	Derrame
        	*
        	*
        	***************************************/
			
			$mensualesDerrames= Derrame::select(DB::raw("Month(fecha) as Mes,count(*) as count"))
				->whereYear('fecha',date('Y'))
				->whereNull('derrames.deleted_at')
				->groupBy(DB::raw("Month(fecha)"))
				->get();

			$Derramexestacion = DB::table('derrames')
				->select('station_id', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('derrames.deleted_at')
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Derramexincidente = DB::table('derrames')
				->join('incidentes', 'derrames.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('derrames.deleted_at')
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

        	return view("/consulta.estadisticas",compact("mensualesInundacion","Inundacionxestacion","Inundacionxincidente","Inundacionxparroquia","mensualesRescate","Rescatexestacion","Rescatexincidente","mensualesTransito","Transitoxestacion","Transitoxincidente","mensualesSalud","Saludxestacion","Saludxincidente","mensualesFuego","Fuegoxestacion","Fuegoxincidente","Incendiosxparroquia","mensualesGas","Gasxestacion","Gasxincidente", "Gasxparroquia", "GasxTipoCilindro", "GasxColor","now","EventosxIncidente","EventosMensuales"));
        }
    }

	public function consultaentrefechas()
	{
		$incidentes = Incidente::all();
		return view("/consulta/consulta",compact('incidentes'));
		
	}

	public function busquedaentrefechas(Request $request)
	{
		$tabla= $request->eventos;
		$fechaD = $request->fechaD;
		$fechaH = $request->fechaH;
		$busquedaentrefechas = DB::table($tabla)
			->join('incidentes', $tabla.'.incidente_id', '=', 'incidentes.id')
			->select('nombre_incidente', DB::raw('count(station_id) salidas'))
			->whereYear('fecha', '=', date('Y'))
			->whereNull($tabla .'.deleted_at')
			->whereBetween('fecha', array($fechaD, $fechaH))
			->groupBy('nombre_incidente')
			->havingRaw('count(station_id) >= ?', [1])
			->get();

		$Busquedaentrefechas_Estaciones = DB::table($tabla)
			->join('stations', $tabla . '.station_id', '=', 'stations.id')
			->select('stations.nombre', DB::raw('count(station_id) salidas'))
			->whereYear('fecha', '=', date('Y'))
			->whereNull($tabla . '.deleted_at')
			->whereBetween('fecha', array($fechaD, $fechaH))
			->groupBy('station_id')
			->havingRaw('count(station_id) >= ?', [1])
			->get();

		$Busquedaentrefechas_Parroquias = DB::table($tabla)
			->join('parroquias',  $tabla . '.parroquia_id', '=', 'parroquias.id')
			->select('parroquias.nombre', DB::raw('count('.$tabla.'.id) salidas'))
			->whereYear('fecha', '=', date('Y'))
			->whereNull($tabla . '.deleted_at')
			->whereBetween('fecha', array($fechaD, $fechaH))
			->groupBy('parroquias.nombre')
			->havingRaw('count('.$tabla.'.id) >= ?', [1])
			->get();

		
			$Busquedaentrefechas_TipoCilindro = DB::table($tabla)
				->join('parroquias',  $tabla . '.parroquia_id', '=', 'parroquias.id')
				->select('parroquias.nombre', DB::raw('count(' . $tabla . '.id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull($tabla . '.deleted_at')
				->whereBetween('fecha', array($fechaD, $fechaH))
				->groupBy('parroquias.nombre')
				->havingRaw('count(' . $tabla . '.id) >= ?', [1])
				->get();

			
		

		return view("/consulta/entrefechas", compact('tabla','Busquedaentrefechas_Parroquias','Busquedaentrefechas_Estaciones','busquedaentrefechas','fechaD','fechaH'));
	}

	public function export($tabla,$fechaD,$fechaH)
	{
		return Excel::download(new Evento_Entre_FechasExport($tabla,$fechaD,$fechaH), 'consulta_'.$tabla.'_'.$fechaD.'_a_'.$fechaH.'.xlsx');
	}

	public function export2($tabla,$fechaD,$fechaH)
	{
		return Excel::download(new TiempoRespuesta_Entre_FechasExport($tabla,$fechaD,$fechaH), 'tiempo_respuesta_'.$tabla.'_'.$fechaD.'_a_'.$fechaH.'.xlsx');
	}


	
	
	





}
