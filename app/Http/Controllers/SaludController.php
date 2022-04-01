<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salud;
use App\Incidente;
use App\Station;
use App\User;
use App\Parroquia;
use App\Cie;
use App\Vehiculo;
use App\Paciente;
use App\Http\Requests\SaveSaludRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Exports\SaludsExport;
use App\Imports\SaludsImport;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class SaludController extends Controller
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
          $estacion_id = trim($request->get('estacion_id'));
          $saluds = Salud::OrderBy('id','desc')
          ->where("direccion",'LIKE','%'.$busq_direccion.'%')
          ->where("station_id",'LIKE','%'.$busq_estacion.'%')
          ->where("fecha",'LIKE','%'.$busq_fecha.'%')
          ->paginate(10);
          return view( "/salud.index",  compact( "saluds","busq_direccion","busq_estacion","busq_fecha" ) );
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
        $parroquias = Parroquia::orderBy('nombre')->get();
        $vehiculos = Vehiculo::orderBy('codigodis')->where('activo','1')->get();
        $cies = Cie::where('nivel','=','3')->get();
        $users = DB::table('users')->where([
          ['cargo','=','Bombero'],
        ])
        ->orWhere('cargo','=','Paramedico')
        ->orderBy("name",'asc')
        ->get();
        $maquinistas = User::where("cargo","Maquinista")
        ->orderBy("name",'asc')
        ->get();
        $incidentes = Incidente::where("tipo_incidente","10_38")
            ->orderBy("nombre_incidente",'asc')
            ->get();

         
                return view( "salud.crear", compact( "incidentes","now","estaciones","users","maquinistas", "parroquias","vehiculos","cies" ) );
           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveSaludRequest $request)
    {
       
         
          try
          {
          
            $salud = new Salud;
            $paciente = new Paciente;
            $salud->incidente_id = $request->incidente_id;
            $salud->tipo_escena = $request->tipo_escena;
            $salud->station_id = $request->station_id;
            $salud->fecha = $request->fecha;
            $salud->direccion = $request->direccion;
            $salud->parroquia_id = $request->parroquia_id;
            $salud->geoposicion = $request->geoposicion;
            $salud->ficha_ecu911 = $request->ficha_ecu911;
            $salud->hora_fichaecu911 = $request->hora_fichaecu911;
            $salud->hora_salida_a_emergencia = $request->hora_salida_a_emergencia;
            $salud->hora_llegada_a_emergencia = $request->hora_llegada_a_emergencia;
            $salud->hora_fin_emergencia = $request->hora_fin_emergencia;
            $salud->hora_en_base = $request->hora_en_base;
            $salud->informacion_inicial = $request->informacion_inicial;
            $salud->detalle_emergencia = $request->detalle_emergencia;
            $salud->usr_creador = auth()->user()->name;
            $salud->save();
            $id = DB::table('saluds')
                  ->select(DB::raw('max(id) as id'))
                  ->first();
            /*
                Sentencias para guardar Los personal que asisten al incidente
            */  
                
            $cont=0;
            $nombresstaff = $request->get('bomberman_id');            
            while ($cont < count($nombresstaff)) {
              $maqui = User::findOrFail($nombresstaff[$cont]);             
              $maqui->saluds()->attach($id);
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
                  $carro->saluds()->attach(
                      $id , [
                        'km_salida' => $kmsalidavehiculo[$cont],
                        'km_llegada' => $kmllegadavehiculo[$cont],
                        'driver_id' => $maqui->id]);
                  $cont=$cont+1;
                }
            //para almacenar personas asistidas en emergencia
            $cont=0;
            $cie10 = $request->get('frcie10');
            
            $usuariof = $request->get('frpaciente');
            $edad = $request->get('fredad');
            $genero = $request->get('frgenero');
            $presion1 = $request->get('frpresion1');
            $presion2 = $request->get('frpresion2');
            $temperatura = $request->get('frtemperatura');
            $glasglow = $request->get('frglasglow');
            $saturacion = $request->get('frsaturacion');
            $hoja = $request->get('frhoja');
            $casasalud = $request->get('frcasasalud');
            $frrespiratoria = $request->get('frrespiratoria');
            $frcardiaca = $request->get('frcardiaca');
            $glicemia = $request->get('frglicemia');
                
            while ($cont < count($cie10)) {
                $paciente->salud_id = $id->id;
                $paciente->cie_id = $cie10[$cont];
                $paciente->paciente = $usuariof[$cont];
                $paciente->edad = $edad[$cont];
                $paciente->genero = $genero[$cont];
                $paciente->presion1 = $presion1[$cont];
                $paciente->presion2 = $presion2[$cont];
                $paciente->temperatura = $temperatura[$cont];
                $paciente->glasglow = $glasglow[$cont];
                $paciente->saturacion = $saturacion[$cont];
                $paciente->hojapre = $hoja[$cont];
                $paciente->casasalud = $casasalud[$cont];
                $paciente->Frecuencia_Cardiaca = $frcardiaca[$cont];
                $paciente->Frecuencia_Respiratoria = $frrespiratoria[$cont];
                $paciente->Glicemia = $glicemia[$cont];
                
                $paciente->save();
                $cont=$cont+1;
              }
              Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
              return redirect( "salud" );
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
         $salud = Salud::findOrFail( $id );
        return view( "salud.show", compact( "salud" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
            $salud = Salud::findOrFail( $id );
           

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
            $incidentes = Incidente::where("tipo_incidente","10_38")
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $cies = Cie::where('nivel','=','3')->get();
            $estaciones = Station::all();
            $parroquias = Parroquia::all();
            $nropersonas = count($salud->users);
            
            return view( "salud.edit", compact("cies","nropersonas","salud","vehiculos","usuarios","maquinistas","incidentes","estaciones","parroquias"));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveSaludRequest $request, $id)
    {
          try
          {
            $salud = Salud::findOrFail( $id );
            $salud->update([
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
                                'usr_editor' => auth()->user()->name
                             ]);
            $salud->users()->detach();
            $salud->vehiculos()->detach();
            /*
                Sentencias para guardar Los personal que asisten al incidente
            */
            $cont=0;
            $nombresstaff = $request->get('bomberman_id');   
            
            while ($cont < count($nombresstaff)) {
                    $bombero = User::findOrFail($nombresstaff[$cont]);
                 
                    $bombero->saluds()->attach($id);
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
                  
                  $carro->saluds()->attach(
                      $id , [
                        'km_salida' => $kmsalidavehiculo[$cont],
                        'km_llegada' => $kmllegadavehiculo[$cont],
                        'driver_id' => $driver_id[$cont]]);
                  $cont=$cont+1;
            }
            /*
                Sentencias para guardar personal atendido en incidente
            */
            $cont=0;
            $frid = $request->get('frid');
            $frpaciente = $request->get('frpaciente');   
            $fredad = $request->get('fredad');
            $frgenero = $request->get('frgenero');
            $frpresion1 = $request->get('frpresion1');
            $frpresion2 = $request->get('frpresion2');
            $frtemperatura = $request->get('frtemperatura');
            $frglasglow = $request->get('frglasglow');
            $frsaturacion = $request->get('frsaturacion');
            $frcardiaca = $request->get('frcardiaca');
            $frrespiratoria = $request->get('frrespiratoria');
            $frglicemia = $request->get('frglicemia');
            $frcasasalud = $request->get('frcasasalud');
            $frcie10 = $request->get('frcie10');
            

            while ($cont < count($frpaciente)) {
                    $paciente = Paciente::findOrFail($frpaciente[$cont]);
                    $paciente->saluds()->attach($id);
                    $cont=$cont+1;
            }

            Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
            return redirect( "salud" );
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
        
            $salud = Salud::findOrFail( $id );
            $salud->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/salud" );
      
    }

    public function export()
    {
        return Excel::download(new SaludsExport, 'salud.xlsx');
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new SaludsImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/salud" );
    }

    public function grafica()
    {
        $saluds= Salud::select(DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(DB::raw("Month(fecha)"))->pluck('count');
            return view("/salud.grafic",compact("saluds"));
    }

    public function importar()
    {
      return view("/salud.import");
    }

    public function downloadPDF($id) {
      $date = Carbon::now();
      $date = $date->format('l jS \\of F Y ');
      $salud = Salud::find($id);
      $dompdf = App::make("dompdf.wrapper");
      $dompdf->loadView('salud.pdf', compact('salud','date'));
      return $dompdf->stream();
    }

    public function cargar($id)
    {
      return view("/salud.carga",compact('id'));
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
    $path      = $file->storeAs('1038/' . $request->id, $nombre);
    $exists = Storage::disk('local')->exists($path);

    //obtenemos el nombre del archivo
    $file207 = $request->file('fileSCI-207');
    $nombre1 = "207." . $file207->getClientOriginalExtension();
    $validation = $request->validate([
      'fileSCI-207' => 'required|file|mimes:pdf|max:2048'
    ]);
    $file      = $validation['fileSCI-207']; // get the validated file
    $path1      = $file->storeAs('1038/' . $request->id, $nombre1);
    $exists1 = Storage::disk('local')->exists($path1);

    //obtenemos el nombre del archivo
    $file211 = $request->file('fileSCI-211');
    $nombre2 = "211." . $file211->getClientOriginalExtension();
    $validation = $request->validate([
      'fileSCI-211' => 'required|file|mimes:pdf|max:2048'
    ]);
    $file      = $validation['fileSCI-211']; // get the validated file        
    $path2      = $file->storeAs('1038/' . $request->id, $nombre2);
    $exists2 = Storage::disk('local')->exists($path2);
        if ($exists&&$exists1&&$exists2) {
          Session::flash('Carga_Correcta',"Formularios Subidos con Exito!!!");
         return redirect( "/salud" );
        } else {
          Session::flash('Carga_Incorrecta',"Evento Tiene Formularios Cargados con Anterioridad.!!!");
          return redirect( "/salud" );
        }
        
    }
}
