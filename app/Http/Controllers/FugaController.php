<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fuga;
use App\Incidente;
use App\Station;
use App\User;
use App\Parroquia;
use App\Vehiculo;
use App\Http\Requests\SaveFugaRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Exports\FugasExport;
use App\Imports\FugasImport;
use PDF;
use Illuminate\Support\Facades\Storage;

class FugaController extends Controller
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
          $fugas = Fuga::where("direccion",'LIKE','%'.$query.'%')
          ->OrderBy('fecha','desc')
          ->paginate(15);
              return view( "/fuga.index", compact( "fugas","query" ) );
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
        $vehiculos = Vehiculo::orderBy('codigodis')->get();
        $users = DB::table('users')->where([
          ['cargo','=','Bombero'],
        ])
        ->orWhere('cargo','=','Paramedico')
        ->orderBy("name",'asc')
        ->get();
        $maquinistas = User::where("cargo","maquinista")
            ->orderBy("name",'asc')
         ->get();
        $incidentes = Incidente::where("tipo_incidente","Fuga")
            ->orderBy("nombre_incidente",'asc')
            ->get();

        if ( Auth::check() ) {
                return view( "/fuga.crear", compact( "incidentes","now","estaciones","users","maquinistas", "parroquias","vehiculos" ) );
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
    public function store(SaveFugaRequest $request)
    {
        if ( Auth::check() )
       {
          DB::begintransaction();
          try
          {
            
            $validated = $request->validated();
            $fuga = new Fuga;
            
                $fuga->incidente_id = $request->incidente_id;
                $fuga->tipo_escena = $request->tipo_escena;
                $fuga->station_id = $request->station_id;
                $fuga->fecha = $request->fecha;
                $fuga->direccion = $request->direccion;
                $fuga->parroquia_id = $request->parroquia_id;
                $fuga->geoposicion = $request->geoposicion;
                $fuga->ficha_ecu911 = $request->ficha_ecu911;
                $fuga->hora_fichaecu911 = $request->hora_fichaecu911;
                $fuga->hora_salida_a_emergencia = $request->hora_salida_a_emergencia;
                $fuga->hora_llegada_a_emergencia = $request->hora_llegada_a_emergencia;
                $fuga->hora_fin_emergencia = $request->hora_fin_emergencia;
                $fuga->hora_en_base = $request->hora_en_base;
                $fuga->informacion_inicial = $request->informacion_inicial;
                $fuga->detalle_emergencia = $request->detalle_emergencia;
                $fuga->tipo_cilindro = $request->tipo_cilindro;
                $fuga->color_cilindro = $request->color_cilindro;
                $fuga->tipo_fallo = $request->tipo_fallo;
                $fuga->usuario_afectado = $request->usuario_afectado;
                $fuga->danos_estimados = $request->danos_estimados;
                $fuga->usr_creador = auth()->user()->name;
                $fuga->save();

            $id = DB::table('fugas')
                ->select(DB::raw('max(id) as id'))
                ->first();
            $maqui = User::findOrFail($request->conductor_id);
            $maqui->fugas()->attach($id);
            $jefe = User::findOrFail($request->jefeguardia_id);
            $jefe->fugas()->attach($id);
            $bomb = User::findOrFail($request->bombero_id);
            $bomb->fugas()->attach($id);
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
                $carro->fugas()->attach(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
                $cont=$cont+1;
              }
              Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
              return redirect( "/fuga" );
          }
          catch(\Exception $e)
          {
              DB::rollback();
              //dd($e);
          }
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
         $fuga = Fuga::findOrFail( $id );
        return view( "fuga.show", compact( "fuga" ) );
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
            
            $fuga = Fuga::findOrFail( $id );
            $vehiculos = Vehiculo::all();
            $bomberos=User::where('cargo','bombero')
            ->orderBy("name",'asc')
            ->get();
            $maquinistas=User::where('cargo','maquinista')
            ->orderBy("name",'asc')
            ->get();
            $incidentes = Incidente::where("tipo_incidente","Fuga")
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $estaciones = Station::all();
            $parroquias = Parroquia::all();

            return view( "fuga.edit", compact("fuga","vehiculos","bomberos","maquinistas","incidentes","estaciones","parroquias"));
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
    public function update(SaveFugaRequest $request , $id)
    {
        if ( Auth::check() ) 
        {
          DB::begintransaction();
          try
          {
           $fuga = Fuga::findOrFail( $id );
           $fuga->update([
                                'incidente_id' => $request->incidente_id,
                                'tipo_escena' => $request->tipo_escena,
                                'station_id' => $request->station_id,
                                'fecha' => $request->fecha,
                                'direccion' => $request->direccion,
                                'parroquia_id' => $fuga->parroquia->id,
                                'geoposicion' => $request->geoposicion,
                                'ficha_ecu911' => $request->ficha_ecu911,
                                'hora_fichaecu911' => $request->hora_fichaecu911,
                                'hora_salida_a_emergencia' => $request->hora_salida_a_emergencia,
                                'hora_llegada_a_emergencia' => $request->hora_llegada_a_emergencia,
                                'hora_fin_emergencia' => $request->hora_fin_emergencia,
                                'hora_en_base' => $request->hora_en_base,
                                'informacion_inicial' => $request->informacion_inicial,
                                'detalle_emergencia' => $request->detalle_emergencia,
                                'tipo_cilindro'=>$request->tipo_cilindro,
                                'color_cilindro' => $request->color_cilindro,
                                'tipo_fallo'=> $request->tipo_fallo,
                                'usuario_afectado' => $request->usuario_afectado,
                                'danos_estimados' => $request->danos_estimados,
                                'usr_editor' => auth()->user()->name ]);
           $fuga->users()->detach();
          

           $jefeguardia = User::findOrFail($request->jefeguardia_id);
           $jefeguardia->fugas()->attach($id);
           
           $bombero = User::findOrFail($request->bombero_id);
           $bombero->fugas()->attach($id);

           $maqui = User::findOrFail($request->conductor_id);
           $maqui->fugas()->attach($id);

           $cont=0;
            $nombrevehiculo = $request->get('vehiculo_id');
            $kmsalidavehiculo = $request->get('km_salida');
            $kmllegadavehiculo = $request->get('km_llegada');
            $fuga->vehiculos()->detach();
            while ($cont < count($nombrevehiculo)) {
                $carro = Vehiculo::findOrFail($nombrevehiculo[$cont]);
                $carro->fugas()->attach(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
                $cont=$cont+1;
           }
           Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
           return redirect( "/fuga" );
          }
          catch(\Exception $e)
          {
              DB::rollback();
              //dd($e);
          }
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
            $fuga = Fuga::findOrFail( $id );
            $fuga->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/fuga" );
        } else {
            return view( "/auth.login" );
        }
    }

    public function export()
    {
        return Excel::download(new FugasExport, 'fugas.xlsx');
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new FugasImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/fuga" );
    }

    public function grafica()
    {
        $fugas= Fuga::select(DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(DB::raw("Month(fecha)"))->pluck('count');
            return view("/fuga.grafic",compact("fugas"));
    }

    public function importar()
    {
      return view("/fuga.import");
    }

    public function downloadPDF($id) {
        $date = Carbon::now();
        $date = $date->format('l jS \\of F Y ');
        $fuga = Fuga::find($id);
        $pdf = PDF::loadView('fuga.pdf', compact('fuga','date'));

        return $pdf->download('fuga.pdf');
    }

    public function cargar($id)
    {
      return view("/fuga.carga",compact('id'));
    }

    public function upload(Request $request)
    {
        //obtenemos el nombre del archivo
        $file201 = $request->file('fileSCI-201');
        $nombre = "201." . $file201->getClientOriginalExtension();
        $validation = $request->validate([
            'fileSCI-201' => 'required|file|mimes:pdf|max:2048'
        ]);
        $file      = $validation['fileSCI-201']; // get the validated file        
        $path      = $file->storeAs('fuga/' . $request->id, $nombre);
        $exists = Storage::disk('local')->exists($path);

        //obtenemos el nombre del archivo
        $file207 = $request->file('fileSCI-207');
        $nombre1 = "207." . $file207->getClientOriginalExtension();
        $validation = $request->validate([
            'fileSCI-207' => 'required|file|mimes:pdf|max:2048'
        ]);
        $file      = $validation['fileSCI-207']; // get the validated file
        $path1      = $file->storeAs('fuga/' . $request->id, $nombre1);
        $exists1 = Storage::disk('local')->exists($path1);

        //obtenemos el nombre del archivo
        $file211 = $request->file('fileSCI-211');
        $nombre2 = "211." . $file211->getClientOriginalExtension();
        $validation = $request->validate([
            'fileSCI-211' => 'required|file|mimes:pdf|max:2048'
        ]);
        $file      = $validation['fileSCI-211']; // get the validated file        
        $path2      = $file->storeAs('fuga/' . $request->id, $nombre2);
        $exists2 = Storage::disk('local')->exists($path2);
        if ($exists&&$exists1&&$exists2) {
          Session::flash('Carga_Correcta',"Formularios Subidos con Exito!!!");
         return redirect( "/fuga" );
        } else {
          Session::flash('Carga_Incorrecta',"Evento Tiene Formularios Cargados con Anterioridad.!!!");
          return redirect( "/fuga" );
        }
        
    }
}
