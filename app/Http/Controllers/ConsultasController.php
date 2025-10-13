<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Inundacion;
use App\Rescate;
use App\Transito;
use App\Salud;
use App\Incendio;
use App\Fuga;
use App\Derrame;
use App\Gasolinera;
use Spatie\Activitylog\Models\Activity;
use App\Exports\Evento_Entre_FechasExport;
use App\Exports\Clave_Entre_FechasExport;
use App\Exports\TiempoRespuesta_Entre_FechasExport;
use App\Exports\Evento_Entre_FechasSaludExport;
use App\Vehiculo;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Carbon;
use Psy\Command\WhereamiCommand;

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
    	$lastActivity = Activity::all();//->last();//returns the  logged activity
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

			$Inundacionxestacion2 = DB::table('inundacions')
				->join('incidentes', 'inundacions.incidente_id', '=', 'incidentes.id')
				->select('station_id', DB::raw('"inundaciones" as evento, count(station_id) salidas'))
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
				->get();
			$Rescatexestacion2 = DB::table('rescates')
				->select('station_id',DB::raw('"rescates" as evento,count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('rescates.deleted_at')
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Rescatexincidente = DB::table('rescates')
				->join('incidentes', 'rescates.incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('rescates.deleted_at')
				->groupBy('nombre_incidente')
				->havingRaw('count(station_id) >= ?',[1])
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

			$Transitoxestacion2 = DB::table('transitos')
				->select('station_id', DB::raw('"transitos" as evento,count(station_id) salidas'))
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

			$Saludxestacion2 = DB::table('saluds')
				->select('station_id', DB::raw('"saluds" as evento,count(station_id) salidas'))
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

			$Fuegoxestacion2 = DB::table('incendios')
				->select('station_id', DB::raw('"incendios" as evento,count(station_id) salidas'))
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

			$Gasxestacion2 = DB::table('fugas')
				->select('station_id', DB::raw('"fugas" as evento,count(station_id) salidas'))
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

			$Derramexestacion2 = DB::table('derrames')
				->select('station_id', DB::raw('"derrames" as evento,count(station_id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('derrames.deleted_at')
				->groupBy('station_id')
				->havingRaw('count(station_id) >= ?',[1])
				->get();

			$Derramexparroquia = DB::table('derrames')
				->join('parroquias', 'derrames.parroquia_id', '=', 'parroquias.id')
				->select('parroquias.nombre', DB::raw('count(derrames.id) salidas'))
				->whereYear('fecha', '=', date('Y'))
				->whereNull('derrames.deleted_at')
				->groupBy('parroquias.nombre')
				->havingRaw('count(derrames.id) >= ?', [1])
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

			$EventosxEstaciones = $Inundacionxestacion2->merge($Rescatexestacion2);
			$EventosxEstaciones = $EventosxEstaciones->merge($Transitoxestacion2);
			$EventosxEstaciones = $EventosxEstaciones->merge($Saludxestacion2);
			$EventosxEstaciones = $EventosxEstaciones->merge($Fuegoxestacion2);
			$EventosxEstaciones = $EventosxEstaciones->merge($Gasxestacion2);
			$EventosxEstaciones = $EventosxEstaciones->merge($Derramexestacion2);
			$EventosxEstaciones = $EventosxEstaciones->sortBy('station_id');
        	return view("/consulta.estadisticas",compact("Derramexparroquia","mensualesDerrames","Derramexestacion","Derramexincidente","mensualesInundacion","Inundacionxestacion","Inundacionxincidente","Inundacionxparroquia","mensualesRescate","Rescatexestacion","Rescatexincidente","mensualesTransito","Transitoxestacion","Transitoxincidente","mensualesSalud","Saludxestacion","Saludxincidente","mensualesFuego","Fuegoxestacion","Fuegoxincidente","Incendiosxparroquia","mensualesGas","Gasxestacion","Gasxincidente", "Gasxparroquia", "GasxTipoCilindro", "GasxColor","now","EventosxIncidente","EventosMensuales","EventosxEstaciones"));
        }
    }

	
	public function consultaentrefechas()
	{
		$gastation = Gasolinera::all();
		$vehicle = Vehiculo::select(['id','codigodis','placa'])->get();
		return view("consulta/consulta",compact("gastation","vehicle"));
		
	}
	

	public function busquedaentrefechasclaveveh(Request $request)
	{
		$tabla= "claves";
		$vehicle = $request->vehicle;
		$fechaD = $request->fechaDvehicle;
		$fechaH = $request->fechaHvehicle;
		

		$busquedaentrefechasclaveveh = DB::table($tabla)
			->select(date("'".$tabla.'created_at'." F'"),'codigodis','claves.created_at')
			->join('vehiculos',  $tabla . '.vehiculo_id', '=', 'vehiculos.id')
			->where('vehiculo_id','=',$vehicle)
			->whereYear($tabla .'.created_at', '=', date('Y'))
			->whereNull($tabla . '.deleted_at')
			->whereBetween($tabla .'.created_at', array($fechaD, $fechaH))
			->get(); 
		//dd($busquedaentrefechasclaveveh);	
		
		return view("/consulta/entrefechasclaveveh", compact('tabla','busquedaentrefechasclaveveh','fechaD','fechaH'));
	}

	public function busquedaentrefechasincidenteveh(Request $request)
	{
		$tabla= $request->eventosveh;
		$incident = substr($tabla, 0, -1);
		$tableveh = substr($tabla, 0, -1).'_vehiculo';
		
		$vehicle = $request->vehicle;
		$codigodis = Vehiculo::findOrFail($vehicle);
		$fechaD = $request->fechaDvehicle;
		$fechaH = $request->fechaHvehicle;
		
		
		$busquedaentrefechasincidenteveh = DB::table($tabla)
			->join($tableveh,$tabla.'.id','=',$tableveh.'.'.$incident.'_id')
			->where($tableveh . '.vehiculo_id','=',$vehicle)
			->whereNull($tabla . '.deleted_at')
			->whereBetween($tabla .'.created_at', array($fechaD, $fechaH))
			->get(); 
		//dd($busquedaentrefechasincidenteveh);	
		
		return view("/consulta/entrefechasincidenteveh", compact('codigodis','tableveh','tabla','busquedaentrefechasincidenteveh','fechaD','fechaH'));
	}

	public function busquedaentrefechas(Request $request)
	{
		$tabla= $request->eventos;
		$fechaD = $request->fechaD;
		$fechaH = $request->fechaH;

		
		if($tabla=="*")
		{
			/**************************************
        	*	Inundacion
        	***************************************/

        	$mensualesInundacion=DB::table('inundacions')
				->whereBetween('fecha', array($fechaD, $fechaH))
        		->whereNull('inundacions.deleted_at')
				->join('incidentes','incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
        		->groupBy('nombre_incidente')
        		->get();

			
			/**************************************
        	*	Rescate
        	***************************************/

			$mensualesRescate= DB::table('rescates')
				->whereBetween('fecha', array($fechaD, $fechaH))
				->whereNull('rescates.deleted_at')
				->join('incidentes','incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->get();

			/**************************************
        	*	Transito
        	***************************************/

			$mensualesTransito=  DB::table('transitos')
				->whereBetween('fecha', array($fechaD, $fechaH))
				->whereNull('transitos.deleted_at')
				->join('incidentes','incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->get();
			
			
			/**************************************
        	*	Salud
        	***************************************/

			$mensualesSalud= DB::table('saluds')
				->whereBetween('fecha', array($fechaD, $fechaH))	
				->whereNull('saluds.deleted_at')
				->join('incidentes','incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->get();

			
			/**************************************
        	*	Fuego
        	***************************************/

			$mensualesFuego= DB::table('incendios')
				->whereBetween('fecha', array($fechaD, $fechaH))	
				->whereNull('incendios.deleted_at')
				->join('incidentes','incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->get();

			/**************************************
        	*	Fuga
        	***************************************/
			
			$mensualesGas= DB::table('fugas')
				->whereBetween('fecha', array($fechaD, $fechaH))
				->whereNull('fugas.deleted_at')
				->join('incidentes','incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->get();

			/**************************************
        	*	Derrame
        	***************************************/
			
			$mensualesDerrames= DB::table('derrames')
				->whereBetween('fecha', array($fechaD, $fechaH))
				->whereNull('derrames.deleted_at')
				->join('incidentes','incidente_id', '=', 'incidentes.id')
				->select('nombre_incidente', DB::raw('count(station_id) salidas'))
				->groupBy('nombre_incidente')
				->get();

			$EventosMensuales = $mensualesInundacion->merge($mensualesRescate);
			$EventosMensuales = $EventosMensuales->merge($mensualesTransito);
			
			$EventosMensuales = $EventosMensuales->merge($mensualesSalud);
			$EventosMensuales = $EventosMensuales->merge($mensualesFuego);
			$EventosMensuales = $EventosMensuales->merge($mensualesGas);
			$EventosMensuales = $EventosMensuales->merge($mensualesDerrames);
			
			return view("/consulta/entrefechasall", compact('EventosMensuales','tabla','fechaD','fechaH'));
		}
		else
		{
			$busquedaentrefechas = DB::table($tabla)
			->join('incidentes', $tabla.'.incidente_id', '=', 'incidentes.id')
			->select('nombre_incidente', DB::raw('count(station_id) salidas'))
			->whereNull($tabla .'.deleted_at')
			->whereBetween('fecha', array($fechaD, $fechaH))
			->groupBy('nombre_incidente')
			->havingRaw('count(station_id) >= ?', [1])
			->get();

			$Busquedaentrefechas_Estaciones = DB::table($tabla)
			->join('stations', $tabla . '.station_id', '=', 'stations.id')
			->select('stations.nombre', DB::raw('count(station_id) salidas'))
			->whereNull($tabla . '.deleted_at')
			->whereBetween('fecha', array($fechaD, $fechaH))
			->groupBy('station_id')
			->havingRaw('count(station_id) >= ?', [1])
			->get();

			$Busquedaentrefechas_Parroquias = DB::table($tabla)
			->join('parroquias',  $tabla . '.parroquia_id', '=', 'parroquias.id')
			->select('parroquias.nombre', DB::raw('count('.$tabla.'.id) salidas'))
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
	}

	public function busquedaentrefechasclave(Request $request)
	{
		$tabla= 'claves';
		$fechaDgas = $request->fechaDgas;
		$fechaHgas = $request->fechaHgas;
		$gastation = $request->gastation;
		
		
		$busquedaentrefechas_xgasolineras = DB::table($tabla)
			->join('gasolineras', $tabla . '.gasolinera_id', '=', 'gasolineras.id')
			->select('razonsocial', DB::raw('count(gasolinera_id) Num_cargas'))
			/* ->where('gasolinera_id','=',$gastation) */
			->whereYear( $tabla .'.created_at', '=', date('Y'))
			->whereNull($tabla .'.deleted_at')
			->whereBetween( $tabla .'.created_at', array($fechaDgas, $fechaHgas)) 
			->groupBy('gasolinera_id')
			->havingRaw('count(gasolinera_id) >= ?', [1])
			->get();

		 $Busquedaentrefechas_xcombustible = DB::table($tabla)
			->select('combustible', DB::raw('count(combustible) NumCargaxCombustible'))
			->where('gasolinera_id','=',$gastation)
			->whereYear( $tabla .'.created_at', '=', date('Y'))
			->whereNull($tabla .'.deleted_at')
			->whereBetween( $tabla .'.created_at', array($fechaDgas, $fechaHgas)) 
			->groupBy('combustible')
			->havingRaw('count(combustible) >= ?', [1])
			->get();

		$Busquedaentrefechas_xvehiculo = DB::table($tabla)
			->join('vehiculos',  $tabla . '.vehiculo_id', '=', 'vehiculos.id')
			->select('vehiculos.codigodis', DB::raw('count('.$tabla.'.vehiculo_id) NumCargas'))
			->where('gasolinera_id','=',$gastation)
			->whereYear($tabla .'.created_at', '=', date('Y'))
			->whereNull($tabla . '.deleted_at')
			->whereBetween($tabla .'.created_at', array($fechaDgas, $fechaHgas))
			->groupBy('vehiculos.codigodis')
			->havingRaw('count(vehiculos.codigodis) >= ?', [1])
			->get(); 
			$gastationname = Gasolinera::findOrFail( $gastation );
		//return $Busquedaentrefechas_xcombustible;
		return view("/consulta/entrefechasclaves", compact('gastationname','tabla','Busquedaentrefechas_xvehiculo','Busquedaentrefechas_xcombustible','busquedaentrefechas_xgasolineras','fechaDgas','fechaHgas'));
	}

	public function export($tabla,$fechaD,$fechaH)
	{
		return Excel::download(new Evento_Entre_FechasExport($tabla,$fechaD,$fechaH), 'consulta_'.$tabla.'_'.$fechaD.'_a_'.$fechaH.'.xlsx');
	}

	public function export3($tabla,$fechaD,$fechaH)
	{
		return Excel::download(new Evento_Entre_FechasSaludExport($tabla,$fechaD,$fechaH), 'consulta_'.$tabla.'_'.$fechaD.'_a_'.$fechaH.'.xlsx');
	}

	public function export2($tabla,$fechaD,$fechaH)
	{
		return Excel::download(new TiempoRespuesta_Entre_FechasExport($tabla,$fechaD,$fechaH), 'tiempo_respuesta_'.$tabla.'_'.$fechaD.'_a_'.$fechaH.'.xlsx');
	}

	public function export4($tabla,$fechaD,$fechaH)
	{
		return Excel::download(new Clave_Entre_FechasExport($tabla,$fechaD,$fechaH), 'consulta_'.$tabla.'_'.$fechaD.'_a_'.$fechaH.'.xlsx');
	}

	public function googlemymapsoptions()
	{
		
		return view("consulta/consultmaps");
		
	}

	public function googlemymaps(Request $request)
	{
		
		$tabla= $request->eventos;
		$fechaD = $request->fechaD;
		$fechaH = $request->fechaH;
		$busquedaentrefechas = DB::table($tabla)
			->join('incidentes', $tabla.'.incidente_id', '=', 'incidentes.id')
			->join('stations', $tabla.'.station_id', '=', 'stations.id')
			->select($tabla.'.id','fecha','nombre_incidente','direccion','stations.nombre','geoposicion',
					'ficha_ecu911','informacion_inicial','detalle_emergencia')
			
			->whereNull($tabla .'.deleted_at')
			->whereBetween('fecha', array($fechaD, $fechaH))
			->get();
		return view("/consulta/googlemymaps", compact('tabla','busquedaentrefechas','fechaD','fechaH'));
	}

	public function GetjsonMaps($tabla,$fechaD,$fechaH){
		
		 $busquedaentrefechas = DB::table($tabla)
			->join('incidentes', $tabla.'.incidente_id', '=', 'incidentes.id')
			->join('stations', $tabla.'.station_id', '=', 'stations.id')
			->select($tabla.'.id','fecha','nombre_incidente','direccion','stations.nombre','geoposicion',
					'ficha_ecu911','informacion_inicial','detalle_emergencia')
			
			->whereNull($tabla .'.deleted_at')
			->whereBetween('fecha', array($fechaD, $fechaH))
			->get()->toJson();
			
			return $busquedaentrefechas;
	}
	
	
	





}
