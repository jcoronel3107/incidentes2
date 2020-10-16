<?php

namespace App\Http\Controllers;

use Illuminate\ Http\ Request;
use App\ Rescate;
use App\ Incidente;
use App\ Station;
use App\ User;
use App\ Parroquia;
use App\ Vehiculo;
use App\ Http\ Requests\ SaveRescateRequest;
use Maatwebsite\ Excel\ Facades\ Excel;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\ Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\ Support\ Facades\Session;
use App\Exports\ RescatesExport;
use App\Imports\ RescatesImport;
use PDF;

class RescateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');

    }

    public function index(Request $request)
    {
        if($request)
        {
          $query = trim($request->get('searchText'));
          $rescates = Rescate::where("fecha",'LIKE','%'.$query.'%')
          ->OrderBy('fecha','asc')
          ->paginate(10);
		      return view( "/rescate.index", compact( "rescates","query" ) );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $now = Carbon::now();
        $estaciones = Station::all();
        $parroquias = Parroquia::all();
        $vehiculos = Vehiculo::all();
        $bomberos = User::where("cargo","bombero")
        ->orderBy("name",'asc')
        ->get();
        $maquinistas = User::where("cargo","maquinista")
        ->orderBy("name",'asc')
        ->get();
    		$incidentes = Incidente::where("tipo_incidente","10_33")
            ->orderBy("nombre_incidente",'asc')
            ->get();

    		if ( Auth::check() ) {
    			return view( "/rescate.crear", compact( "incidentes","now","estaciones","bomberos","maquinistas", "parroquias","vehiculos" ) );
    		} else {
    			return view( "/auth.login" );
    		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRescateRequest $request)
    {
  		if ( Auth::check() )
       {
          //try
          //{
            //DB::begintransaction();
          $validated = $request->validated();
          $rescate = new Rescate;
          $incidente_id = DB::table('incidentes')
              ->where('nombre_incidente', $request->incidente_id)
              ->value('id');
          $estacion_id = DB::table('stations')
              ->where('nombre', $request->station_id)
              ->value('id');
          $parroquia_id = DB::table('parroquias')
              ->where('nombre', $request->parroquia_id)
              ->value('id');
          $jefeguardia_id= DB::table('users')
                ->where('name',$request->jefeguardia_id)
                ->value('id');
          $conductor_id = DB::table('users')
            ->where('name',$request->conductor_id)
            ->value('id');
          $bombero_id= DB::table('users')
            ->where('name',$request->bombero_id)
            ->value('id');
    			$rescate->incidente_id = $incidente_id;
    			$rescate->tipo_escena = $request->tipo_escena;
    			$rescate->station_id = $estacion_id;
    			$rescate->fecha = $request->fecha;
    			$rescate->direccion = $request->direccion;
    			$rescate->parroquia_id = $parroquia_id;
    			$rescate->geoposicion = $request->geoposicion;
    			$rescate->ficha_ecu911 = $request->ficha_ecu911;
    			$rescate->hora_fichaecu911 = $request->hora_fichaecu911;
    			$rescate->hora_salida_a_emergencia = $request->hora_salida_a_emergencia;
    			$rescate->hora_llegada_a_emergencia = $request->hora_llegada_a_emergencia;
    			$rescate->hora_fin_emergencia = $request->hora_fin_emergencia;
    			$rescate->hora_en_base = $request->hora_en_base;
    			$rescate->informacion_inicial = $request->informacion_inicial;
    			$rescate->detalle_emergencia = $request->detalle_emergencia;
    			$rescate->usuario_afectado = $request->usuario_afectado;
    			$rescate->danos_estimados = $request->danos_estimados;
    			$rescate->usr_creador = auth()->user()->name;
    			$rescate->save();
          $id = DB::table('rescates')
            ->select(DB::raw('max(id) as id'))
            ->first();
          $maqui = User::findOrFail($conductor_id);
          $maqui->rescates()->attach($id);
          $jefe = User::findOrFail($jefeguardia_id);
          $jefe->rescates()->attach($id);
          $bomb = User::findOrFail($bombero_id);
          $bomb->rescates()->attach($id);

          //para almacenar kilimetrajes por vehiculos asistentes al evento
            $cont=0;
            $nombrevehiculo = $request->get('vehiculo_id');
            $kmsalidavehiculo = $request->get('km_salida');
            $kmllegadavehiculo = $request->get('km_llegada');
            while ($cont < count($nombrevehiculo)) {
                $vehiculo_id = DB::table('vehiculos')
                  ->where('codigodis',$nombrevehiculo[$cont])
                  ->value('id');
                $carro = vehiculo::findOrFail($vehiculo_id);
                $carro->rescates()->attach(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
                $cont=$cont+1;
              }
          Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
          return redirect( "/rescate" );
          //}
          //catch(\Exception $e)
          //{
          //    DB::rollback();
          //}
  		} else {
  			return view( "/auth.login" );
  		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $rescate = Rescate::findOrFail( $id );
        return view( "rescate.show", compact( "rescate" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function edit($id) {
        //
        if ( Auth::check() ) {
            $conductor_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $bombero_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $rescate = Rescate::findOrFail( $id );
            $vehiculos = Vehiculo::all();
            $bomberos=User::where('cargo','bombero')
            ->orderBy("name",'asc')
            ->get();
            $maquinistas=User::where('cargo','maquinista')
            ->orderBy("name",'asc')
            ->get();
            $incidentes = Incidente::where("tipo_incidente","10_33")
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $estaciones = Station::all();
            $parroquias = Parroquia::all();

            return view( "rescate.edit", compact("rescate","vehiculos","bomberos","maquinistas","incidentes","estaciones","parroquias"));
        } else {
            return view( "/auth.login" );
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update(SaveRescateRequest $request , $id ) {
        //
        if ( Auth::check() ) {

                $jefeguardia_id = DB::table('users')->where('name', $request->jefeguardia_id)->value('id');
                $incidente_id = DB::table('incidentes')->where('nombre_incidente', $request->incidente_id)->value('id');
                $station_id = DB::table('stations')->where('nombre', $request->station_id)->value('id');
                $parroquia_id = DB::table('parroquias')->where('nombre', $request->parroquia_id)->value('id');
                $rescate = Rescate::findOrFail( $id );
                $rescate->update([
                                'incidente_id' => $incidente_id,
                                'tipo_escena' => $request->tipo_escena,
                                'station_id' => $station_id,
                                'fecha' => $request->fecha,
                                'direccion' => $request->direccion,
                                'parroquia_id' => $parroquia_id,
                                'geoposicion' => $request->geoposicion,
                                'ficha_ecu911' => $request->ficha_ecu911,
                                'hora_fichaecu911' => $request->hora_fichaecu911,
                                'hora_salida_a_emergencia' => $request->hora_salida_a_emergencia,
                                'hora_llegada_a_emergencia' => $request->hora_llegada_a_emergencia,
                                'hora_fin_emergencia' => $request->hora_fin_emergencia,
                                'hora_en_base' => $request->hora_en_base,
                                'informacion_inicial' => $request->informacion_inicial,
                                'detalle_emergencia' => $request->detalle_emergencia,
                                'usuario_afectado' => $request->usuario_afectado,
                                'danos_estimados' => $request->danos_estimados,
                                'usr_editor' => auth()->user()->name ]);

            Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
            return redirect( "/rescate" );
        } else {
            return view( "/auth.login" );
        }
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
        if ( Auth::check() ) {
            $rescate = Rescate::findOrFail( $id );
            $rescate->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/rescate" );
        } else {
            return view( "/auth.login" );
        }
    }

    public function export()
    {
        return Excel::download(new RescatesExport, 'rescates.xlsx');
    }

    public function grafica()
    {
        $rescates= Rescate::select(\DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(\DB::raw("Month(fecha)"))->pluck('count');
            return view("/rescate.grafic",compact("rescates"));
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new RescatesImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/rescate" );
    }

     public function importar()
    {
      return view("/rescate.import");
    }

    public function downloadPDF($id) {
        $rescate = Rescate::find($id);
        $pdf = PDF::loadView('rescate.pdf', compact('rescate'));
        return $pdf->download('rescate.pdf');


  }
}
