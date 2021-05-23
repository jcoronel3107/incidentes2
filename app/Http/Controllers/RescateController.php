<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rescate;
use App\Incidente;
use App\Station;
use App\User;
use App\Parroquia;
use App\Vehiculo;
use App\Http\Requests\SaveRescateRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Exports\RescatesExport;
use App\Imports\RescatesImport;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;


class RescateController extends Controller
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
          $rescates = Rescate::OrderBy('id','desc')
          ->where("direccion",'LIKE','%'.$busq_direccion.'%')
          ->where("station_id",'LIKE','%'.$busq_estacion.'%')
          ->where("fecha",'LIKE','%'.$busq_fecha.'%')
          ->where("usuario_afectado",'LIKE','%'.$busq_usuarioafectado.'%')
          ->paginate(10);
		      return view( "/rescate.index", compact( "rescates","busq_direccion","busq_estacion","busq_fecha","busq_usuarioafectado" ) );
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
        $bomberos = DB::table('users')->where([
          ['cargo','=','Bombero'],
        ])
        ->orWhere('cargo','=','Paramedico')
        ->orderBy("name",'asc')
        ->get();
        $maquinistas = User::where("cargo","Maquinista")
        ->orderBy("name",'asc')
        ->get();
    		$incidentes = Incidente::where("tipo_incidente","10_33")
            ->orderBy("nombre_incidente",'asc')
            ->get();

    	
    			return view( "/rescate.crear", compact( "incidentes","now","estaciones","bomberos","maquinistas", "parroquias","vehiculos" ) );
    	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRescateRequest $request)
    {
  		
          
          try
          {
          
             
              $rescate = new Rescate;
              
    	        $rescate->incidente_id = $request->incidente_id;
              $rescate->tipo_escena = $request->tipo_escena;
    			    $rescate->station_id = $request->station_id;
      			  $rescate->fecha = $request->fecha;
    			    $rescate->direccion = $request->direccion;
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
              $id = DB::table('rescates')
                  ->select(DB::raw('max(id) as id'))
                  ->value('id');
              $maqui = User::findOrFail($request->conductor_id);
              $maqui->rescates()->attach($id);
              $jefe = User::findOrFail($request->jefeguardia_id);
              $jefe->rescates()->attach($id);
              $bomb = User::findOrFail($request->bombero_id);
              $bomb->rescates()->attach($id);

              //para almacenar kilimetrajes por vehiculos asistentes al evento
              $cont=0;
              $nombrevehiculo = $request->get('vehiculo_id');
              $kmsalidavehiculo = $request->get('km_salida');
              $kmllegadavehiculo = $request->get('km_llegada');
              while ($cont < count($nombrevehiculo)) {
                  
                  $carro = vehiculo::findOrFail($nombrevehiculo[$cont]);
                  $carro->rescates()->attach(
                    $id , [
                      'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
                  $cont=$cont+1;
              }
              Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
              return redirect( "/rescate" );
          }
          catch(\Exception $e)
          {
              
             
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
       
            $rescate = Rescate::findOrFail( $id );
            $vehiculos = Vehiculo::orderBy('codigodis')->where('activo','1')->get();
            
            $bomberos = DB::table('users')->where([
              ['cargo','=','Bombero'],
            ])
            ->orWhere('cargo','=','Paramedico')
            ->orderBy("name",'asc')
            ->get();
            $maquinistas=User::where('cargo','Maquinista')
            ->orderBy("name",'asc')
            ->get();
            $incidentes = Incidente::where("tipo_incidente","10_33")
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $estaciones = Station::all();
            $parroquias = Parroquia::all();

            return view( "rescate.edit", compact("rescate","vehiculos","bomberos","maquinistas","incidentes","estaciones","parroquias"));
          
     
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update(SaveRescateRequest $request , $id ) {
     
          
          try
          {
            $rescate = Rescate::findOrFail( $id );
            $rescate->update([
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
                                'usr_editor' => auth()->user()->name ]);
            $rescate->users()->detach();
            $jefeguardia = User::findOrFail($request->jefeguardia_id);
            $jefeguardia->rescates()->attach($id);
           
            $bombero = User::findOrFail($request->bombero_id);
            $bombero->rescates()->attach($id);

            $maqui = User::findOrFail($request->conductor_id);
            $maqui->rescates()->attach($id);
            
            $cont=0;
            $nombrevehiculo = $request->get('vehiculo_id');
            $kmsalidavehiculo = $request->get('km_salida');
            $kmllegadavehiculo = $request->get('km_llegada');
           
            $rescate->vehiculos()->detach();
            while ($cont < count($nombrevehiculo)) {
                $carro = Vehiculo::findOrFail($nombrevehiculo[$cont]);
                $carro->rescates()->attach(
                $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
                $cont=$cont+1;
            }
            Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
            return redirect( "/rescate" );
          }
          catch(\Exception $e)
          {
             
            
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
        
            $rescate = Rescate::findOrFail( $id );
            $rescate->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/rescate" );
      
    }

    public function export()
    {
        return Excel::download(new RescatesExport, 'rescates.xlsx');
    }

    public function grafica()
    {
        $rescates= Rescate::select(DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(DB::raw("Month(fecha)"))->pluck('count');
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
      $date = Carbon::now();
      $date = $date->format('l jS \\of F Y ');
      $rescate = Rescate::find($id);
      $dompdf = App::make("dompdf.wrapper");
      $dompdf->loadView('rescate.pdf', compact('rescate','date'));
      return $dompdf->stream();
    }

    public function cargar($id)
    {
      return view("/rescate.carga",compact('id'));
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
        $path      = $file->storeAs('1033/' . $request->id, $nombre);
        $exists = Storage::disk('local')->exists($path);

        //obtenemos el nombre del archivo
        $file207 = $request->file('fileSCI-207');
        $nombre1 = "207." . $file207->getClientOriginalExtension();
        $validation = $request->validate([
            'fileSCI-207' => 'required|file|mimes:pdf|max:2048'
        ]);
        $file      = $validation['fileSCI-207']; // get the validated file
        $path1      = $file->storeAs('1033/' . $request->id, $nombre1);
        $exists1 = Storage::disk('local')->exists($path1);

        //obtenemos el nombre del archivo
        $file211 = $request->file('fileSCI-211');
        $nombre2 = "211." . $file211->getClientOriginalExtension();
        $validation = $request->validate([
            'fileSCI-211' => 'required|file|mimes:pdf|max:2048'
        ]);
        $file      = $validation['fileSCI-211']; // get the validated file        
        $path2      = $file->storeAs('1033/' . $request->id, $nombre2);
        $exists2 = Storage::disk('local')->exists($path2);
        if ($exists&&$exists1&&$exists2) {
          Session::flash('Carga_Correcta',"Formularios Subidos con Exito!!!");
         return redirect( "/rescate" );
        } else {
          Session::flash('Carga_Incorrecta',"Evento Tiene Formularios Cargados con Anterioridad.!!!");
          return redirect( "/rescate" );
        }
        
    }

}
