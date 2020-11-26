<?php

namespace App\Http\Controllers;

use Illuminate\ Http\ Request;
use App\ Transito;
use App\ Incidente;
use App\ Station;
use App\ User;
use App\ Parroquia;
use App\ Vehiculo;
use App\ Http\ Requests\ SavetransitoRequest;
use Maatwebsite\ Excel\ Facades\ Excel;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\ Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\ Support\ Facades\Session;
use App\Exports\ TransitosExport;
use App\Imports\ TransitosImport;
use PDF;
use Illuminate\Support\Facades\Storage;


class TransitoController extends Controller
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
        //
        if($request)
        {
          $query = trim($request->get('searchText'));
          $transitos = Transito::where("fecha",'LIKE','%'.$query.'%')
          ->OrderBy('fecha','asc')
          ->paginate(10);
              return view( "/transito.index", compact( "transitos","query" ) );
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
        $incidentes = Incidente::where("tipo_incidente","10_42")
            ->orderBy("nombre_incidente",'asc')
            ->get();

            if ( Auth::check() ) {
                return view( "/transito.crear", compact( "incidentes","now","estaciones","bomberos","maquinistas", "parroquias","vehiculos" ) );
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
    public function store(SaveTransitoRequest $request)
    {
        if ( Auth::check() )
       {
          //try
          //{
            //DB::begintransaction();
          /*$validated = $request->validated();*/
          $transito = new Transito;
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
                $transito->incidente_id = $incidente_id;
                $transito->tipo_escena = $request->tipo_escena;
                $transito->station_id = $estacion_id;
                $transito->fecha = $request->fecha;
                $transito->direccion = $request->direccion;
                $transito->parroquia_id = $parroquia_id;
                $transito->geoposicion = $request->geoposicion;
                $transito->ficha_ecu911 = $request->ficha_ecu911;
                $transito->hora_fichaecu911 = $request->hora_fichaecu911;
                $transito->hora_salida_a_emergencia = $request->hora_salida_a_emergencia;
                $transito->hora_llegada_a_emergencia = $request->hora_llegada_a_emergencia;
                $transito->hora_fin_emergencia = $request->hora_fin_emergencia;
                $transito->hora_en_base = $request->hora_en_base;
                $transito->informacion_inicial = $request->informacion_inicial;
                $transito->detalle_emergencia = $request->detalle_emergencia;
                $transito->usuario_afectado = $request->usuario_afectado;
                $transito->danos_estimados = $request->danos_estimados;
                $transito->usr_creador = auth()->user()->name;
                $transito->save();
          $id = DB::table('transitos')
            ->select(DB::raw('max(id) as id'))
            ->first();
          $maqui = User::findOrFail($conductor_id);
          $maqui->transitos()->attach($id);
          $jefe = User::findOrFail($jefeguardia_id);
          $jefe->transitos()->attach($id);
          $bomb = User::findOrFail($bombero_id);
          $bomb->transitos()->attach($id);

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
                $carro->transitos()->attach(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
                $cont=$cont+1;
              }
          Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
          return redirect( "/transito" );
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
        $transito = Transito::findOrFail( $id );
        return view( "transito.show", compact( "transito" ) );
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
            $transito = Transito::findOrFail( $id );
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

            return view( "transito.edit", compact("transito","vehiculos","bomberos","maquinistas","incidentes","estaciones","parroquias"));
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
    public function update(Request $request, $id)
    {
        if ( Auth::check() ) {

                $jefeguardia_id = DB::table('users')->where('name', $request->jefeguardia_id)->value('id');
                $incidente_id = DB::table('incidentes')->where('nombre_incidente', $request->incidente_id)->value('id');
                $station_id = DB::table('stations')->where('nombre', $request->station_id)->value('id');
                $parroquia_id = DB::table('parroquias')->where('nombre', $request->parroquia_id)->value('id');
                $transito = Transito::findOrFail( $id );
                $transito->update([
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
                $transito->users()->detach();
                $jefeguardia = User::findOrFail($request->jefeguardia_id);
                $jefeguardia->transitos()->attach($id);
           
                $bombero = User::findOrFail($request->bombero_id);
                $bombero->transitos()->attach($id);

                $maqui = User::findOrFail($request->conductor_id);
                $maqui->transitos()->attach($id);
            Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
            return redirect( "/transito" );
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
            $transito = Transito::findOrFail( $id );
            $transito->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/transito" );
        } else {
            return view( "/auth.login" );
        }
    }

    public function export()
    {
        return Excel::download(new TransitosExport, 'transito.xlsx');
    }

    public function grafica()
    {
        $transitos= Transito::select(\DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(\DB::raw("Month(fecha)"))->pluck('count');
            return view("/transito.grafic",compact("transitos"));
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new TransitosImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/transito" );
    }

     public function importar()
    {
      return view("/transito.import");
    }

    public function downloadPDF($id) {
        $transito = Transito::find($id);
        $pdf = PDF::loadView('transito.pdf', compact('transito'));
        return $pdf->download('transito.pdf');
    }

    public function cargar($id)
    {
      return view("/transito.carga",compact('id'));
    }

    public function upload(Request $request)
    {
       $file201 = $request->file('fileSCI-201');
       $file202 = $request->file('fileSCI-202');
       $file206 = $request->file('fileSCI-206');


       //obtenemos el nombre del archivo

       $nombre = "201.".$file201->getClientOriginalExtension();;
       $nombre1 = "202.".$file202->getClientOriginalExtension();
       $nombre2 = "206A.".$file206->getClientOriginalExtension();
       
       $validation = $request->validate([
        'fileSCI-201' => 'required|file|mimes:pdf|max:1048'
        
        ]);
        
      
        $file      = $validation['fileSCI-201']; // get the validated file        
        $path      = $file->storeAs('1042/'.$request->id, $nombre);
        $validation = $request->validate([
        'fileSCI-202' => 'required|file|mimes:pdf|max:1048'
        
        ]);
        
       
        $file      = $validation['fileSCI-202']; // get the validated file
        $path1      = $file->storeAs('1042/'.$request->id, $nombre1);
        $validation = $request->validate([
        'fileSCI-206' => 'required|file|mimes:pdf|max:1048'
       
        ]);
        
      
        $file      = $validation['fileSCI-206']; // get the validated file        
        $path2      = $file->storeAs('1042/'.$request->id, $nombre2);
        $exists = Storage::disk('local')->exists($path);
        $exists1 = Storage::disk('local')->exists($path1);
        $exists2 = Storage::disk('local')->exists($path2);
        if ($exists&&$exists1&&$exists2) {
          Session::flash('Carga_Correcta',"Formularios Subidos con Exito!!!");
         return redirect( "/transito" );
        } else {
          Session::flash('Carga_Incorrecta',"Evento Tiene Formularios Cargados con Anterioridad.!!!");
          return redirect( "/transito" );
        }
        
    }
}
