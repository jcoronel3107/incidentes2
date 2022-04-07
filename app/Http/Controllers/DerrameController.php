<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Derrame;
use App\Incidente;
use App\Station;
use App\User;
use App\Parroquia;
use App\Vehiculo;
use App\Http\Requests\SaveDerrameRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Exports\DerramesExport;
use App\Imports\DerramesImport;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class DerrameController extends Controller
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
          $derrames = Derrame::OrderBy('id','desc')
          ->where("address",'LIKE','%'.$busq_direccion.'%')
          ->where("station_id",'LIKE','%'.$busq_estacion.'%')
          ->where("fecha",'LIKE','%'.$busq_fecha.'%')
          ->where("usuario_afectado",'LIKE','%'.$busq_usuarioafectado.'%')
          ->paginate(10);
              return view( "/derrame.index", compact( "derrames","busq_direccion","busq_estacion","busq_fecha","busq_usuarioafectado" ) );
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
        $users = User::where("cargo","bombero")
            ->orderBy("name",'asc')
            ->get();
        $maquinistas = User::where("cargo","Maquinista")
            ->orderBy("name",'asc')
            ->get();
        $incidentes = Incidente::where("tipo_incidente","Derrame")
            ->orderBy("nombre_incidente",'asc')
            ->get();
                     return view( "/derrame.crear", compact( "incidentes","now","estaciones","users","maquinistas", "parroquias","vehiculos" ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveDerrameRequest $request)
    {
          try
          {
              $rescate = new Derrame;
              
     	        $rescate->incidente_id = $request->incidente_id;
              $rescate->tipo_escena = $request->tipo_escena;
    			    $rescate->station_id = $request->station_id;
      			  $rescate->fecha = $request->fecha;
    			    $rescate->address = $request->address;
    			    $rescate->parroquia_id = $request->parroquia_id;
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
              
              $id = DB::table('derrames')
                  ->select(DB::raw('max(id) as id'))
                  ->value('id');
              /*
                Sentencias para guardar Los personal que asisten al incidente
              */  
                
                $cont=0;
                $nombresstaff = $request->get('bomberman_id');
                
                while ($cont < count($nombresstaff)) {
                    $maqui = User::findOrFail($nombresstaff[$cont]);
                   
                    $maqui->derrames()->attach($id);
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
                  
                  $carro->derrames()->attach(
                      $id , [
                        'km_salida' => $kmsalidavehiculo[$cont],
                        'km_llegada' => $kmllegadavehiculo[$cont],
                        'driver_id' => $maqui->id]);
                  $cont=$cont+1;
                }

              
              Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
              return redirect( "derrame" );
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
         $derrame = Derrame::findOrFail( $id );
        return view( "derrame.show", compact( "derrame" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function edit($id) {
       
      $derrame = Derrame::findOrFail( $id );
      $vehiculos = Vehiculo::orderBy('codigodis')->where('activo','1')->get();
      
      $maquinistas=User::where('cargo','Maquinista')
      ->orderBy("name",'asc')
      ->get();
      
      $incidentes = Incidente::where("tipo_incidente","Derrame")
      ->orderBy("nombre_incidente",'asc')
      ->get();
      
      $usuarios = DB::table('users')->where([
        ['cargo','=','Bombero'],
      ])
      ->orWhere('cargo','=','Paramedico')
      ->orderBy("name",'asc')
      ->get();
    
      $nropersonas = count($derrame->users);
      $estaciones = Station::all();
      $parroquias = Parroquia::all();

      return view( "derrame.edit", compact("nropersonas","derrame","vehiculos","usuarios","maquinistas","incidentes","estaciones","parroquias"));
    

}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update(SaveDerrameRequest $request , $id ) {
     
          
      try
      {
        $derrame = Derrame::findOrFail( $id );
        $derrame->update([
                            'incidente_id' => $request->incidente_id,
                            'tipo_escena' => $request->tipo_escena,
                            'station_id' => $request->station_id,
                            'fecha' => $request->fecha,
                            'address' => $request->address,
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
                            'usr_editor' => auth()->user()->name
                         ]);
        $derrame->users()->detach();
        $derrame->vehiculos()->detach();
        /*
            Sentencias para guardar Los personal que asisten al incidente
        */
        $cont=0;
        $nombresstaff = $request->get('bomberman_id');   
        
        while ($cont < count($nombresstaff)) {
                $bombero = User::findOrFail($nombresstaff[$cont]);
             
                $bombero->derrames()->attach($id);
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
              
              $carro->derrames()->attach(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],
                    'km_llegada' => $kmllegadavehiculo[$cont],
                    'driver_id' => $driver_id[$cont]]);
              $cont=$cont+1;
        }

        Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
        return redirect( "derrame" );
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
            $derrame = Derrame::findOrFail( $id );
            $derrame->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/derrame" );
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
        $derrames= Derrame::select(DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(DB::raw("Month(fecha)"))->pluck('count');
            return view("/derrame.grafic",compact("derrames"));
    }

    public function importar()
    {
      return view("/derrame.import");
    }

    public function downloadPDF($id) {
        $date = Carbon::now();
        $date = $date->format('l jS \\of F Y ');
        $derrame = Derrame::find($id);
        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView('derrame.pdf', compact('derrame','date'));
        return $dompdf->stream();
        
        
       
    }

    public function cargar($id)
    {
      return view("/derrame.carga",compact('id'));
    }

   public function upload(Request $request)
   {
        $file201 = $request->file('fileSCI-201');//obtenemos el nombre del archivo
        $nombre = "201." . $file201->getClientOriginalExtension();
        $validation = $request->validate(['fileSCI-201' => 'required|file|mimes:pdf|max:2048']);
        $file      = $validation['fileSCI-201']; // get the validated file        
        $path      = $file->storeAs('hazmat/' . $request->id, $nombre);
        $exists = Storage::disk('local')->exists($path);
        $file207 = $request->file('fileSCI-207');//obtenemos el nombre del archivo
        $nombre1 = "207." . $file207->getClientOriginalExtension();
        $validation = $request->validate(['fileSCI-207' => 'required|file|mimes:pdf|max:2048']);
        $file      = $validation['fileSCI-207']; // get the validated file
        $path1      = $file->storeAs('hazmat/' . $request->id, $nombre1);
        $exists1 = Storage::disk('local')->exists($path1);
        $file211 = $request->file('fileSCI-211');//obtenemos el nombre del archivo
        $nombre2 = "211.".$file211->getClientOriginalExtension();
        $validation = $request->validate(['fileSCI-211' => 'required|file|mimes:pdf|max:2048']);  
        $file      = $validation['fileSCI-211']; // get the validated file        
        $path2      = $file->storeAs('hazmat/'.$request->id, $nombre2);
        $exists2 = Storage::disk('local')->exists($path2);
        if ($exists && $exists1 && $exists2) 
        {
          Session::flash('Carga_Correcta',"Formularios Subidos con Exito!!!");
          return redirect( "/derrame" );
        } 
        else
        {
          Session::flash('Carga_Incorrecta',"Evento Tiene Formularios Cargados con Anterioridad.!!!");
          return redirect( "/derrame" );
        }
    }

    public function inspeccion($id)
    {
       
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
            $maquinistas=User::where('cargo','Maquinista')
            ->orderBy("name",'asc')
            ->get();
            $incidentes = Incidente::where("tipo_incidente","hazmat")
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $estaciones = Station::all();
            $parroquias = Parroquia::all();
            return view( "/derrame.inspeccion", compact("derrame","vehiculos","bomberos","maquinistas","incidentes","estaciones","parroquias"));
      
        
    }

    public function registra_Inspeccion(Request $request)
    {
    }


}
