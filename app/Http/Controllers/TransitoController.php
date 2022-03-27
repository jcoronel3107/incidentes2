<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transito;
use App\Incidente;
use App\Station;
use App\User;
use App\Parroquia;
use App\Vehiculo;
use App\Http\Requests\SaveTransitoRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Exports\TransitosExport;
use App\Imports\TransitosImport;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;


class TransitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  
    public function index(Request $request)
    {
        //
        if($request)
        {
          $busq_direccion = trim($request->get('busq_direccion'));
            $busq_estacion = trim($request->get('busq_estacion'));
            $busq_fecha = trim($request->get('busq_fecha'));
            $busq_usuarioafectado = trim($request->get('busq_usuarioafectado'));
          $transitos = Transito::OrderBy('id','desc')
          ->where("direccion",'LIKE','%'.$busq_direccion.'%')
          ->where("station_id",'LIKE','%'.$busq_estacion.'%')
          ->where("fecha",'LIKE','%'.$busq_fecha.'%')
          ->where("usuario_afectado",'LIKE','%'.$busq_usuarioafectado.'%')
          ->paginate(10);
              
              return view( "transito.index", compact( "transitos","busq_direccion","busq_estacion","busq_fecha","busq_usuarioafectado" ) );
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
          ['cargo','=','Bombero']
        ])
        ->orWhere('cargo','=','Paramedico')
        ->orderBy("name",'asc')
        ->get();
        $maquinistas = User::where("cargo","Maquinista")
            ->orderBy("name",'asc')
            ->get();
        $incidentes = Incidente::where("tipo_incidente","10_42")
            ->orderBy("nombre_incidente",'asc')
            ->get();

           
         return view( "/transito.crear", compact( "incidentes","now","estaciones","users","maquinistas", "parroquias","vehiculos" ) );
           
         return view( "/auth.login" );
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveTransitoRequest $request)
    {
          try
          {
            $transito = new Transito;
            $transito->incidente_id = $request->incidente_id;
            $transito->tipo_escena = $request->tipo_escena;
            $transito->station_id = $request->station_id;
            $transito->fecha = $request->fecha;
            $transito->direccion = $request->direccion;
            $transito->parroquia_id = $request->parroquia_id;
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
              $id = DB::table('rescates')
                  ->select(DB::raw('max(id) as id'))
                  ->first();
              /*
                Sentencias para guardar Los personal que asisten al incidente
                */  
                
                $cont=0;
                $nombresstaff = $request->get('bomberman_id');
                
                while ($cont < count($nombresstaff)) {
                    $maqui = User::findOrFail($nombresstaff[$cont]);
                   
                    $maqui->transitos()->attach($id);
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
                  
                  $carro->transitos()->attach(
                      $id , [
                        'km_salida' => $kmsalidavehiculo[$cont],
                        'km_llegada' => $kmllegadavehiculo[$cont],
                        'driver_id' => $maqui->id]);
                  $cont=$cont+1;
                }

              
              Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
              return redirect( "transito" );
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
      
            $conductor_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $transito = Transito::findOrFail( $id );
            $vehiculos = Vehiculo::orderBy('codigodis')->where('activo','1')->get();
            $usuarios = DB::table('users')->where([
              ['cargo','=','Bombero'],
            ])
            ->orWhere('cargo','=','Paramedico')
            ->orderBy("name",'asc')
            ->get();
            $maquinistas=User::where('cargo','Maquinista')
            ->orderBy("name",'asc')
            ->get();
            $incidentes = Incidente::where("tipo_incidente","10_42")
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $nropersonas = count($transito->users);
            $estaciones = Station::all();
            $parroquias = Parroquia::all();

            return view( "transito.edit", compact("nropersonas","transito","vehiculos","usuarios","maquinistas","incidentes","estaciones","parroquias"));
    
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
       
         
          try
          {
                $transito = Transito::findOrFail( $id );
                $transito->update([
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
                                $transito->users()->detach();
                                $transito->vehiculos()->detach();
                                /*
                                    Sentencias para guardar Los personal que asisten al incidente
                                */
                                $cont=0;
                                $nombresstaff = $request->get('bomberman_id');   
                                
                                while ($cont < count($nombresstaff)) {
                                        $bombero = User::findOrFail($nombresstaff[$cont]);
                                     
                                        $bombero->transitos()->attach($id);
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
                                      
                                      $carro->transitos()->attach(
                                          $id , [
                                            'km_salida' => $kmsalidavehiculo[$cont],
                                            'km_llegada' => $kmllegadavehiculo[$cont],
                                            'driver_id' => $driver_id[$cont]]);
                                      $cont=$cont+1;
                                }
                    
                                Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
                                return redirect( "transito" );
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
       
            $transito = Transito::findOrFail( $id );
            $transito->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/transito" );
      
    }

    public function export()
    {
        return Excel::download(new TransitosExport, 'transito.xlsx');
    }

    public function grafica()
    {
        $transitos= Transito::select(DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(DB::raw("Month(fecha)"))->pluck('count');
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
      $date = Carbon::now();
      $date = $date->format('l jS \\of F Y ');
      $transito = Transito::find($id);
      $dompdf = App::make("dompdf.wrapper");
      $dompdf->loadView('transito.pdf', compact('transito','date'));
      return $dompdf->stream();
    }

    public function cargar($id)
    {
      return view("/transito.carga",compact('id'));
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
        $path      = $file->storeAs('1042/' . $request->id, $nombre);
        $exists = Storage::disk('local')->exists($path);

        //obtenemos el nombre del archivo
        $file207 = $request->file('fileSCI-207');
        $nombre1 = "207." . $file207->getClientOriginalExtension();
        $validation = $request->validate([
            'fileSCI-207' => 'required|file|mimes:pdf|max:2048'
        ]);
        $file      = $validation['fileSCI-207']; // get the validated file
        $path1      = $file->storeAs('1042/' . $request->id, $nombre1);
        $exists1 = Storage::disk('local')->exists($path1);

        //obtenemos el nombre del archivo
        $file211 = $request->file('fileSCI-211');
        $nombre2 = "211." . $file211->getClientOriginalExtension();
        $validation = $request->validate([
            'fileSCI-211' => 'required|file|mimes:pdf|max:2048'
        ]);
        $file      = $validation['fileSCI-211']; // get the validated file        
        $path2      = $file->storeAs('1042/' . $request->id, $nombre2);
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
