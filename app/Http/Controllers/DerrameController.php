<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ Derrame;
use App\ Incidente;
use App\ Station;
use App\ User;
use App\ Parroquia;
use App\ Vehiculo;
use App\ Http\ Requests\ SaveDerrameRequest;
use Maatwebsite\ Excel\ Facades\ Excel;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\ Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\ Support\ Facades\Session;
use App\Exports\ DerramesExport;
use App\Imports\ DerramesImport;
use PDF;

class DerrameController extends Controller
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
          $derrames = Derrame::where("fecha",'LIKE','%'.$query.'%')
          ->OrderBy('fecha','desc')
          ->paginate(10);
              return view( "/derrame.index", compact( "derrames","query" ) );
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
        $users = User::where("cargo","bombero")
            ->orderBy("name",'asc')
            ->get();
        $maquinistas = User::where("cargo","maquinista")
            ->orderBy("name",'asc')
         ->get();
        $incidentes = Incidente::where("tipo_incidente","Derrame")
            ->orderBy("nombre_incidente",'asc')
            ->get();

        if ( Auth::check() ) {
                return view( "/derrame.crear", compact( "incidentes","now","estaciones","users","maquinistas", "parroquias","vehiculos" ) );
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
    public function store(SaveDerrameRequest $request)
    {
        if ( Auth::check() )
       {
          //try
          //{
            //DB::begintransaction();
            $validated = $request->validated();
            $derrame = new Derrame;
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
                $derrame->incidente_id = $incidente_id;
                $derrame->tipo_escena = $request->tipo_escena;
                $derrame->station_id = $estacion_id;
                $derrame->fecha = $request->fecha;
                $derrame->address = $request->address;
                $derrame->parroquia_id = $parroquia_id;
                $derrame->geoposicion = $request->geoposicion;
                $derrame->ficha_ecu911 = $request->ficha_ecu911;
                $derrame->hora_fichaecu911 = $request->hora_fichaecu911;
                $derrame->hora_salida_a_emergencia = $request->hora_salida_a_emergencia;
                $derrame->hora_llegada_a_emergencia = $request->hora_llegada_a_emergencia;
                $derrame->hora_fin_emergencia = $request->hora_fin_emergencia;
                $derrame->hora_en_base = $request->hora_en_base;
                $derrame->informacion_inicial = $request->informacion_inicial;
                $derrame->detalle_emergencia = $request->detalle_emergencia;
                $derrame->usuario_afectado = $request->usuario_afectado;
                $derrame->danos_estimados = $request->danos_estimados;
                $derrame->usr_creador = auth()->user()->name;
                $derrame->save();

            $id = DB::table('derrames')
                ->select(DB::raw('max(id) as id'))
                ->first();
            $maqui = User::findOrFail($conductor_id);
            $maqui->derrames()->attach($id);
            $jefe = User::findOrFail($jefeguardia_id);
            $jefe->derrames()->attach($id);
            $bomb = User::findOrFail($bombero_id);
            $bomb->derrames()->attach($id);
            //para almacenar kilimetrajes por vehiculos asistentes al evento
            $cont=0;
            $nombrevehiculo = $request->get('vehiculo_id');
            $kmsalidavehiculo = $request->get('km_salida');
            $kmllegadavehiculo = $request->get('km_llegada');
            while ($cont < count($nombrevehiculo)) {
                $vehiculo_id = DB::table('vehiculos')
                  ->where('codigodis',$nombrevehiculo[$cont])
                  ->value('id');
                $carro = Vehiculo::findOrFail($vehiculo_id);
                $carro->derrames()->attach(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
                $cont=$cont+1;
              }
              Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
              return redirect( "/derrame" );
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
         $derrame = Derrame::findOrFail( $id );
        return view( "derrame.show", compact( "derrame" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ( Auth::check() ) {
            $conductor_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $bombero_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $derrame = Derrame::findOrFail( $id );
            $vehiculos = Vehiculo::all();
            $bomberos=User::where('cargo','bombero')
            ->orderBy("name",'asc')
            ->get();
            $maquinistas=User::where('cargo','maquinista')
            ->orderBy("name",'asc')
            ->get();
            
            $incidentes = Incidente::where("tipo_incidente","Derrame")
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $estaciones = Station::all();
            $parroquias = Parroquia::all();

            return view( "derrame.edit", compact("derrame","vehiculos","bomberos","maquinistas","incidentes","estaciones","parroquias"));
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
    public function update(SaveDerrameRequest $request , $id)
    {
       if ( Auth::check() ) {

           $jefeguardia_id = DB::table('users')->where('name', $request->jefeguardia_id)->value('id');
           $incidente_id = DB::table('incidentes')->where('nombre_incidente', $request->incidente_id)->value('id');
           $station_id = DB::table('stations')->where('nombre', $request->station_id)->value('id');
           $derrame = Derrame::findOrFail( $id );
           $derrame->update([
                                'incidente_id' => $incidente_id,
                                'tipo_escena' => $request->tipo_escena,
                                'station_id' => $station_id,
                                'fecha' => $request->fecha,
                                'address' => $request->address,
                                'parroquia_id' => $derrame->parroquia->id,
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
            return redirect( "/derrame" );
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
        if ( Auth::check() ) {
            $derrame = Derrame::findOrFail( $id );
            $derrame->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/derrame" );
        } else {
            return view( "/auth.login" );
        }
    }

    public function export()
    {
        return Excel::download(new DerramesExport, 'derrames.xlsx');
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new DerramesImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/derrame" );
    }

    public function grafica()
    {
        $derrames= Derrame::select(\DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(\DB::raw("Month(fecha)"))->pluck('count');
            return view("/derrame.grafic",compact("derrames"));
    }

    public function importar()
    {
      return view("/derrame.import");
    }

    public function downloadPDF($id) {
        $derrame = Derrame::find($id);
        $pdf = PDF::loadView('derrame.pdf', compact('derrame'));

        return $pdf->download('derrame.pdf');
    }
}
