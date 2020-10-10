<?php

namespace App\Http\Controllers;

use Illuminate\ Http\ Request;
use App\ Incendio;
use App\ Incidente;
use App\ Station;
use App\ User;
use App\ Parroquia;
use App\ Vehiculo;
use App\ Http\ Requests\ SaveIncendioRequest;
use Maatwebsite\ Excel\ Facades\ Excel;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\ Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\ Support\ Facades\Session;
use App\Exports\ IncendiosExport;
use App\Imports\ IncendiosImport;
use PDF;

class IncendioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request) {
        if($request)
        {
            $query = trim($request->get('searchText'));
            $incendios = Incendio::where("created_at",'LIKE','%'.$query.'%')
              ->OrderBy('created_at','desc')
              ->paginate(10);
            return view( "/fuego.index", compact( "incendios","query" ) );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        $now = Carbon::now();
        $vehiculos = Vehiculo::all();
        $estaciones = Station::all();
        $parroquias = Parroquia::all();
        $incidentes = Incidente::where("tipo_incidente","10_70")
        ->orderBy("nombre_incidente",'asc')
        ->get();
        $maquinistas = User::where("cargo","maquinista")
        ->orderBy("name",'asc')
        ->get();
        $users = User::where("cargo","bombero")
        ->orderBy("name",'asc')
        ->get();

        if ( Auth::check() ) {
            return view( "/fuego.crear",compact("vehiculos","users","incidentes","now","estaciones","parroquias","maquinistas") );
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
    public function store(SaveIncendioRequest $request) {
        if ( Auth::check() ) {
            $validated = $request->validated();
            $incidente_id = DB::table('incidentes')
            ->where('nombre_incidente', $request->incidente_id)
            ->value('id');
            $estacion_id = DB::table('stations')
            ->where('nombre', $request->station_id)
            ->value('id');
            $parroquia_id = DB::table('parroquias')
            ->where('nombre', $request->parroquia_id)
            ->value('id');
            $incendio = new Incendio;
            $incendio->incidente_id = $incidente_id;
            $incendio->tipo_escena = $request->tipo_escena;
            $incendio->station_id = $estacion_id;
            $incendio->fecha = $request->fecha;
            $incendio->direccion = $request->direccion;
            $incendio->parroquia_id = $parroquia_id;
            $incendio->geoposicion = $request->geoposicion;
            $incendio->ficha_ecu911 = $request->ficha_ecu911;
            $incendio->hora_fichaecu911 = $request->hora_fichaecu911;
            $incendio->hora_salida_a_emergencia = $request->hora_salida_a_emergencia;
            $incendio->hora_llegada_a_emergencia = $request->hora_llegada_a_emergencia;
            $incendio->hora_fin_emergencia = $request->hora_fin_emergencia;
            $incendio->hora_en_base = $request->hora_en_base;
            $incendio->informacion_inicial = $request->informacion_inicial;
            $incendio->detalle_emergencia = $request->detalle_emergencia;
            $incendio->usuario_afectado = $request->usuario_afectado;
            $incendio->danos_estimados = $request->danos_estimados;
            $conductor_id = DB::table('users')
            ->where('name',$request->conductor_id)
            ->value('id');

            $jefeguardia_id= DB::table('users')
            ->where('name',$request->jefeguardia_id)
            ->value('id');

            $bombero_id= DB::table('users')
            ->where('name',$request->bombero_id)
            ->value('id');

            $incendio->usr_creador = auth()->user()->name;
            $incendio->save();
            $id = DB::table('incendios')
                     ->select(DB::raw('max(id) as id'))
                     ->first();
            $maqui = User::findOrFail($conductor_id);
            $maqui->incendios()->attach($id);
            $jefe = User::findOrFail($jefeguardia_id);
            $jefe->incendios()->attach($id);
            $bomb = User::findOrFail($bombero_id);
            $bomb->incendios()->attach($id);
            /*
            Sentencias para guardar Los vehiculos que asisten al incidente
            */
            $cont=0;
            $nombrevehiculo = $request->get('vehiculo_id');
            $kmsalidavehiculo = $request->get('km_salida');
            $kmllegadavehiculo = $request->get('km_llegada');
            while ($cont < count($nombrevehiculo)) {
               $vehiculo_id = DB::table('vehiculos')
                ->where('codigodis',$nombrevehiculo[$cont])
                ->value('id');
              $carro = vehiculo::findOrFail($vehiculo_id);
              $carro->incendios()->attach(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
              $cont=$cont+1;
            }
            Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
            return redirect( "/fuego" );
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
    public

    function show( $id ) {
        //
        $incendio = Incendio::findOrFail( $id );
        return view( "fuego.show", compact( "incendio" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public

    function edit($id) {
       if ( Auth::check() ) {
            $conductor_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $bombero_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $incendio = Incendio::findOrFail( $id );
            $vehiculos = Vehiculo::all();
            $bomberos=User::where('cargo','bombero')
            ->orderBy("name",'asc')
            ->get();
            $maquinistas=User::where('cargo','maquinista')
            ->orderBy("name",'asc')
            ->get();
            $incidentes = Incidente::where('tipo_incidente','=','10_70')
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $estaciones = Station::all();
            $parroquias = Parroquia::all();

            return view( "fuego.edit", compact("incendio","vehiculos","bomberos","maquinistas","incidentes","estaciones","parroquias"));
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
    public

    function update( SaveIncendioRequest $request , $id ) {
        if ( Auth::check() ) {
            $userid = DB::table('users')->where('name', $request->user_id)->value('id');
                echo ($userid);
            $idvehiculo = DB::table('vehiculos')->where('codigodis', $request->vehiculo_id)->value('id');
            $incidente_id = DB::table('incidentes')->where('nombre_incidente', $request->incidente_id)->value('id');
            $station_id = DB::table('stations')->where('nombre', $request->station_id)->value('id');
            $incendio = Incendio::findOrFail( $id );
            $incendio->update([
                           'incidente_id' => $incidente_id,
                           'tipo_escena' => $request->tipo_escena,
                           'station_id' => $station_id,
                            'fecha' => $request->fecha,
                            'direccion' => $request->direccion,
                            'parroquia_id' => $incendio->parroquia->id,
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
            //  return $request->km_salida;
            Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
            return redirect( "/fuego" );
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
    public

    function destroy( $id ) {
        //
        if ( Auth::check() ) {
            $incendio = Incendio::findOrFail( $id );
            $incendio->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/fuego" );
        } else {
            return view( "/auth.login" );
        }
    }

    public function export()
    {
        return Excel::download(new IncendiosExport, 'incendios.xlsx');
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new IncendiosImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/fuego" );
    }

    public function grafica()
    {
        $incendios= Incendio::select(\DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(\DB::raw("Month(fecha)"))->pluck('count');
            return view("/fuego.grafic",compact("incendios"));
    }

    public function importar()
    {
      return view("/fuego.import");
    }

    public function downloadPDF($id) {
        $incendio = Incendio::find($id);
        $pdf = PDF::loadView('fuego.pdf', compact('incendio'));

        return $pdf->download('incendio.pdf');
    }
}
