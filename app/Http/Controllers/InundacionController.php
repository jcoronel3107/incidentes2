<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inundacion;
use App\Incidente;
use App\Station;
use App\User;
use App\Parroquia;
use App\Vehiculo;
use App\Http\Requests\SaveInundacionRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Exports\InundacionsExport;
use App\Imports\InundacionsImport;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;



class InundacionController extends Controller
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
            
            $inundaciones = Inundacion::OrderBy('id','desc')
            ->where("direccion",'LIKE','%'.$busq_direccion.'%')
            ->where("station_id",'LIKE','%'.$busq_estacion.'%')
            ->where("fecha",'LIKE','%'.$busq_fecha.'%')
            ->where("usuario_afectado",'LIKE','%'.$busq_usuarioafectado.'%')
            ->paginate(10);
		        return view("inundacion.index",compact( "inundaciones","busq_direccion","busq_estacion","busq_fecha","busq_usuarioafectado" ) );
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
    		$incidentes = Incidente::where("tipo_incidente","10_20")
            ->orderBy("nombre_incidente",'asc')
            ->get();
        return view( "/inundacion.crear", compact( "incidentes","now","estaciones","users","maquinistas", "parroquias","vehiculos") );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveInundacionRequest $request)
    {
          try
          {
            $inundacion = new Inundacion;
        		$inundacion->incidente_id = $request->incidente_id;
        		$inundacion->tipo_escena = $request->tipo_escena;
        		$inundacion->station_id = $request->station_id;
        		$inundacion->fecha = $request->fecha;
        		$inundacion->direccion = $request->direccion;
        		$inundacion->parroquia_id = $request->parroquia_id;
        		$inundacion->geoposicion = $request->geoposicion;
        		$inundacion->ficha_ecu911 = $request->ficha_ecu911;
        		$inundacion->hora_fichaecu911 = $request->hora_fichaecu911;
        		$inundacion->hora_salida_a_emergencia = $request->hora_salida_a_emergencia;
        		$inundacion->hora_llegada_a_emergencia = $request->hora_llegada_a_emergencia;
        		$inundacion->hora_fin_emergencia = $request->hora_fin_emergencia;
        		$inundacion->hora_en_base = $request->hora_en_base;
        		$inundacion->informacion_inicial = $request->informacion_inicial;
        		$inundacion->detalle_emergencia = $request->detalle_emergencia;
        		$inundacion->usuario_afectado = $request->usuario_afectado;
        		$inundacion->danos_estimados = $request->danos_estimados;
        		$inundacion->usr_creador = auth()->user()->name;
        		$inundacion->save();

            $id = DB::table('inundacions')
                ->select(DB::raw('max(id) as id'))
                ->value('id');
            $cont=0;
            $nombresstaff = $request->get('bomberman_id');
            while ($cont < count($nombresstaff)) {
              $maqui = User::findOrFail($nombresstaff[$cont]);
              $maqui->inundacions()->attach($id);
              $cont=$cont+1;
            }
            //para almacenar kilimetrajes por vehiculos asistentes al evento
            $cont=0;
            $nombrevehiculo = $request->get('vehiculo_id');
            $kmsalidavehiculo = $request->get('km_salida');
            $kmllegadavehiculo = $request->get('km_llegada');
            $driver_id= $request->get('driver_id');
            while ($cont < count($nombrevehiculo)) {
                
                $carro = vehiculo::findOrFail($nombrevehiculo[$cont]);
                $maqui = User::findOrFail($driver_id[$cont]);
                $carro->inundacions()->attach(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],
                    'km_llegada' => $kmllegadavehiculo[$cont],
                    'driver_id' => $maqui->id]);
                $cont=$cont+1;
              }
              Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
              return redirect( "/inundacion" );
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
        $inundacion = Inundacion::findOrFail( $id );

        return view( "inundacion.show", compact( "inundacion" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function edit($id) {
       
            $conductor_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $bombero_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $inundacion = Inundacion::findOrFail( $id );
            $vehiculos = Vehiculo::orderBy('codigodis')->where('activo','1')->get();
            $usuarios = DB::table('users')->where([
              ['cargo','=','Bombero'],
            ])
            ->orWhere('cargo','=','Paramedico')
            ->orderBy("name",'asc')
            ->get();
          
            $nropersonas = count($inundacion->users);
            $maquinistas=User::where('cargo','Maquinista')
            ->orderBy("name",'asc')
            ->get();
            $incidentes = Incidente::where("tipo_incidente","10_20")
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $estaciones = Station::all();
            $parroquias = Parroquia::all();

            return view( "inundacion.edit", compact("nropersonas","inundacion","vehiculos","usuarios","maquinistas","incidentes","estaciones","parroquias"));
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update( SaveInundacionRequest $request , $id ) {
      
          try
          { 
            $inundacion = Inundacion::findOrFail( $id );
            $inundacion->update([
                                'incidente_id' => $request->incidente_id,
                                'tipo_escena' => $request->tipo_escena,
                                'station_id' => $request->station_id,
                                'fecha' => $request->fecha,
                                'direccion' => $request->direccion,
                                'parroquia_id' => $inundacion->parroquia->id,
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
                                'usr_editor' => auth()->user()->name]);
                                
                                $inundacion->users()->detach();
                                $inundacion->vehiculos()->detach();
                                /*
                                    Sentencias para guardar Los personal que asisten al incidente
                                */
                                $cont=0;
                                $nombresstaff = $request->get('bomberman_id');   
                                
                                while ($cont < count($nombresstaff)) {
                                        $bombero = User::findOrFail($nombresstaff[$cont]);
                                     
                                        $bombero->inundacions()->attach($id);
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
                                      
                                      $carro->inundacions()->attach(
                                          $id , [
                                            'km_salida' => $kmsalidavehiculo[$cont],
                                            'km_llegada' => $kmllegadavehiculo[$cont],
                                            'driver_id' => $driver_id[$cont]]);
                                      $cont=$cont+1;
                                }
                    
                                Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
                                return redirect( "inundacion" );
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
        
            $inundacion = Inundacion::findOrFail( $id );
            $inundacion->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/inundacion" );
       
    }

    public function export()
    {
        return Excel::download(new InundacionsExport, 'inundacions.xlsx');
    }

    

    public function grafica()
    {
        $inundaciones= Inundacion::select(DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(DB::raw("Month(fecha)"))->pluck('count');
            return view("/inundacion.grafic",compact("inundaciones"));
    }

    public function importar() /* Muestra la vista para realizar la importacion de informacion hacia modelo */
    {
      return view("/inundacion.import");
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new InundacionsImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/inundacion" );
    }

    
    public function downloadPDF($id) {
      $date = Carbon::now();
      $date = $date->format('l jS \\of F Y ');
      $inundacion = Inundacion::find($id);
      $dompdf = App::make("dompdf.wrapper");
      $dompdf->loadView('inundacion.pdf', compact('inundacion','date'));
      return $dompdf->stream();
    }

    public function cargar($id)
    {
      return view("/inundacion.carga",compact('id'));
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
      $path      = $file->storeAs('1020/' . $request->id, $nombre);
      $exists = Storage::disk('local')->exists($path);

      //obtenemos el nombre del archivo
      $file207 = $request->file('fileSCI-207');
      $nombre1 = "207." . $file207->getClientOriginalExtension();
      $validation = $request->validate([
        'fileSCI-207' => 'required|file|mimes:pdf|max:2048'
      ]);
      $file      = $validation['fileSCI-207']; // get the validated file
      $path1      = $file->storeAs('1020/' . $request->id, $nombre1);
      $exists1 = Storage::disk('local')->exists($path1);

      //obtenemos el nombre del archivo
      $file211 = $request->file('fileSCI-211');
      $nombre2 = "211." . $file211->getClientOriginalExtension();
      $validation = $request->validate([
        'fileSCI-211' => 'required|file|mimes:pdf|max:2048'
      ]);
      $file      = $validation['fileSCI-211']; // get the validated file        
      $path2      = $file->storeAs('1020/' . $request->id, $nombre2);
      $exists2 = Storage::disk('local')->exists($path2);
          if ($exists&&$exists1&&$exists2) {
            Session::flash('Carga_Correcta',"Formularios Subidos con Exito!!!");
          return redirect( "/inundacion" );
          } else {
            Session::flash('Carga_Incorrecta',"Evento Tiene Formularios Cargados con Anterioridad.!!!");
            return redirect( "/inundacion" );
          }
          
          
        
    }

    public function inspeccion($id)
    {
      
    }


    public function registra_Inspeccion(Request $request)
    {

    }
}
