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
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class FugaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        if($request)
        {
            $busq_direccion = trim($request->get('busq_direccion'));
            $busq_estacion = trim($request->get('busq_estacion'));
            $busq_fecha = trim($request->get('busq_fecha'));
            $busq_usuarioafectado = trim($request->get('busq_usuarioafectado'));
          $fugas = Fuga::OrderBy('id','desc')
          ->where("direccion",'LIKE','%'.$busq_direccion.'%')
          ->where("station_id",'LIKE','%'.$busq_estacion.'%')
          ->where("fecha",'LIKE','%'.$busq_fecha.'%')
          ->where("usuario_afectado",'LIKE','%'.$busq_usuarioafectado.'%')
          ->paginate(10);
          return view("fuga.index",compact( "fugas","busq_direccion","busq_estacion","busq_fecha","busq_usuarioafectado" ) );
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
        $vehiculos = Vehiculo::orderBy('codigodis')->where('activo','1')->get();
        $users = DB::table('users')->where([
          ['cargo','=','Bombero'],
        ])
        ->orWhere('cargo','=','Paramedico')
        ->orderBy("name",'asc')
        ->get();
        $maquinistas = User::where("cargo","Maquinista")
            ->orderBy("name",'asc')
         ->get();
        $incidentes = Incidente::where("tipo_incidente","Fuga")
            ->orderBy("nombre_incidente",'asc')
            ->get();

        
                return view( "/fuga.crear", compact( "incidentes","now","estaciones","users","maquinistas", "parroquias","vehiculos" ) );
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveFugaRequest $request)
    {
      try
      {
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
          $fuga->usuario_afectado = $request->usuario_afectado;
          $fuga->danos_estimados = $request->danos_estimados;
          $fuga->Tipo_cilindro = $request->tipo_cilindro;
          $fuga->Color_cilindro = $request->color_cilindro;
          $fuga->Tipo_fallo = $request->tipo_fallo;
          $fuga->usr_creador = auth()->user()->name;

          $fuga->save();

          $id = DB::table('fugas')
              ->select(DB::raw('max(id) as id'))
              ->value('id');
          /*
            Sentencias para guardar Los personal que asisten al incidente
            */  
            
            $cont=0;
            $nombresstaff = $request->get('bomberman_id');
            
            while ($cont < count($nombresstaff)) {
                $maqui = User::findOrFail($nombresstaff[$cont]);
               
                $maqui->fugas()->attach($id);
                $cont+=1;
            }

            /*
            Sentencias para guardar Los vehiculos que asisten al incidente
            */

            $cont=0;
            $nombrevehiculo = $request->get('vehiculo_id');
            $kmsalidavehiculo = $request->get('km_salida');
            $kmllegadavehiculo = $request->get('km_llegada');
            $driver_id= $request->get('driver_id');
            
            while ($cont < count($nombrevehiculo)) {
               
              $carro = vehiculo::findOrFail($nombrevehiculo[$cont]);
              $maqui = User::findOrFail($driver_id[$cont]);
              
              $carro->fugas()->attach(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],
                    'km_llegada' => $kmllegadavehiculo[$cont],
                    'driver_id' => $maqui->id]);
              $cont=$cont+1;
            }

          
          Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
          return redirect( "fuga" );
      }
      catch(\Exception $e)
      {
          dd($e);
         
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
    function edit($id) {
       
      $fuga = Fuga::findOrFail( $id );
      $vehiculos = Vehiculo::orderBy('codigodis')->where('activo','1')->get();
      
      $maquinistas=User::where('cargo','Maquinista')
      ->orderBy("name",'asc')
      ->get();
      
      $incidentes = Incidente::where("tipo_incidente","10_33")
      ->orderBy("nombre_incidente",'asc')
      ->get();
      
      $usuarios = DB::table('users')->where([
        ['cargo','=','Bombero'],
      ])
      ->orWhere('cargo','=','Paramedico')
      ->orderBy("name",'asc')
      ->get();
    
      $nropersonas = count($fuga->users);
      $estaciones = Station::all();
      $parroquias = Parroquia::all();

      return view( "fuga.edit", compact("nropersonas","fuga","vehiculos","usuarios","maquinistas","incidentes","estaciones","parroquias"));
    

 
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update(SaveFugaRequest $request , $id ) {
     
          
      try
      {
        $fuga = Fuga::findOrFail( $id );
        $fuga->update([
                            'incidente_id' => $request->incidente_id,
                            'tipo_escena' => $request->tipo_escena,
                            'station_id' => $request->station_id,
                            'fecha' => $request->fecha,
                            'direccion' => $request->direccion,
                            'parroquia_id' => $request->parroquia_id,
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
                            'tipo_cilindro' => $request->tipo_cilindro,
                            'color_cilindro' => $request->color_cilindro,
                            'tipo_fallo' => $request->tipo_fallo,
                            'usr_editor' => auth()->user()->name
                         ]);
        $fuga->users()->detach();
        $fuga->vehiculos()->detach();
        /*
            Sentencias para guardar Los personal que asisten al incidente
        */
        $cont=0;
        $nombresstaff = $request->get('bomberman_id');   
        
        while ($cont < count($nombresstaff)) {
                $bombero = User::findOrFail($nombresstaff[$cont]);
             
                $bombero->fugas()->attach($id);
                $cont=$cont+1;
        }
       
        /*
            Sentencias para guardar Los vehiculos que asisten al incidente
        */
        $cont=0;
        $nombrevehiculo = $request->get('vehiculo_id');
        $kmsalidavehiculo = $request->get('km_salida');
        $kmllegadavehiculo = $request->get('km_llegada');
        $driver_id= $request->get('driver_id');
        
        while ($cont < count($nombrevehiculo)) {
               
              $carro = vehiculo::findOrFail($nombrevehiculo[$cont]);
              // $maqui = User::findOrFail($driver_id[$cont]);
              
              $carro->fugas()->attach(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],
                    'km_llegada' => $kmllegadavehiculo[$cont],
                    'driver_id' => $driver_id[$cont]]);
              $cont=$cont+1;
        }

        Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
        return redirect( "fuga" );
      }
      catch(\Exception $e)
      {
         dd($e);
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
        
            $fuga = Fuga::findOrFail( $id );
            $fuga->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/fuga" );
        
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
        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView('fuga.pdf', compact('fuga','date'));
        return $dompdf->stream();
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

    public function inspeccion($id)
    {
        return view("prevencion.crear");
    }


    public function registra_Inspeccion(Request $request)
    {

    }
}
