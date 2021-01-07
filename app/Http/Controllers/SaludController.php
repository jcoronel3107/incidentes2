<?php

namespace App\Http\Controllers;

use Illuminate\ Http\ Request;
use App\ Salud;
use App\ Incidente;
use App\ Station;
use App\ User;
use App\ Parroquia;
use App\ Cie;
use App\ Vehiculo;
use App\ Paciente;
use App\ Http\ Requests\ SaveSaludRequest;
use Maatwebsite\ Excel\ Facades\ Excel;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\ Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\ Support\ Facades\Session;
use App\Exports\ SaludsExport;
use App\Imports\ SaludsImport;
use PDF;
use Illuminate\Support\Facades\Storage;

class SaludController extends Controller
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
          $saluds = Salud::where("fecha",'LIKE','%'.$query.'%')
          ->OrderBy('fecha','desc')
          ->paginate(10);
              return view( "/salud.index", compact( "saluds","query" ) );
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
        $vehiculos = Vehiculo::orderBy('codigodis')->get();
        $cies = Cie::where('nivel','=','3')->get();
        $users = DB::table('users')->where([
          ['cargo','=','Bombero'],
        ])
        ->orWhere('cargo','=','Paramedico')
        ->orderBy("name",'asc')
        ->get();
        $maquinistas = User::where("cargo","maquinista")
        ->orderBy("name",'asc')
        ->get();
        $incidentes = Incidente::where("tipo_incidente","10_38")
            ->orderBy("nombre_incidente",'asc')
            ->get();

            if ( Auth::check() ) {
                return view( "/salud.crear", compact( "incidentes","now","estaciones","users","maquinistas", "parroquias","vehiculos","cies" ) );
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
    public function store(SaveSaludRequest $request)
    {
        if ( Auth::check() )
       {
          //try
          //{
            //DB::begintransaction();
            /*$validated = $request->validated();*/
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
            //dd($request);
            $salud->save();
            //para almacenar Bomberos asistentes al evento
            $id = DB::table('saluds')
                ->select(DB::raw('max(id) as id'))
                ->value('id');
            $maqui = User::findOrFail($request->conductor_id);
            $maqui->saluds()->sync($id);
            $jefe = User::findOrFail($request->jefeguardia_id);
            $jefe->saluds()->sync($id);
            $bomb = User::findOrFail($request->bombero_id);
            $bomb->saluds()->sync($id);

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
                $carro->saluds()->attach(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
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
                $paciente->salud_id = $id;
                 $cie_id = DB::table('cies')
                  ->where('codigo',$cie10[$cont])
                  ->value('id');

                $paciente->cie_id = $cie_id;
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
              return redirect( "/salud" );
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
        if ( Auth::check() ) {
            $conductor_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $bombero_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $salud = Salud::findOrFail( $id );
            $vehiculos = Vehiculo::all();
            $bomberos=User::where('cargo','bombero')
            ->orderBy("name",'asc')
            ->get();
            $maquinistas=User::where('cargo','maquinista')
            ->orderBy("name",'asc')
            ->get();
            $incidentes = Incidente::where("tipo_incidente","10_38")
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $estaciones = Station::all();
            $parroquias = Parroquia::all();

            return view( "salud.edit", compact("salud","vehiculos","bomberos","maquinistas","incidentes","estaciones","parroquias"));
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
    public function update(SaveSaludRequest $request, $id)
    {
        if ( Auth::check() ) {
          
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
                                'usr_editor' => auth()->user()->name ]);
          $salud->users()->detach();
          

          $jefeguardia = User::findOrFail($request->jefeguardia_id);
          $jefeguardia->saluds()->attach($id);
          
          $bombero = User::findOrFail($request->bombero_id);
          $bombero->saluds()->attach($id);
          
          $maqui = User::findOrFail($request->conductor_id);
          $maqui->saluds()->attach($id);
          
          $cont=0;
          $nombrevehiculo = $request->get('vehiculo_id');
          $kmsalidavehiculo = $request->get('km_salida');
          $kmllegadavehiculo = $request->get('km_llegada');
          $salud->vehiculos()->detach();
          while ($cont < count($nombrevehiculo)) {
                //dd($id)  ;
                /*$vehiculo_id = DB::table('vehiculos')
                  ->where('codigodis',$nombrevehiculo[$cont])
                  ->value('id');
                  dd($vehiculo_id);*/
                $carro = Vehiculo::findOrFail($nombrevehiculo[$cont]);
                $carro->saluds()->attach(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
                $cont=$cont+1;
          }

          Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
          return redirect( "/salud" );
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
            $salud = Salud::findOrFail( $id );
            $salud->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/salud" );
        } else {
            return view( "/auth.login" );
        }
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
        $saluds= Salud::select(\DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(\DB::raw("Month(fecha)"))->pluck('count');
            return view("/salud.grafic",compact("saluds"));
    }

    public function importar()
    {
      return view("/salud.import");
    }

    public function downloadPDF($id) {
        $salud = Salud::find($id);
        $pdf = PDF::loadView('salud.pdf', compact('salud'));
        return $pdf->download('salud.pdf');
    }

    public function cargar($id)
    {
      return view("/salud.carga",compact('id'));
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
        $path      = $file->storeAs('1038/'.$request->id, $nombre);
        $validation = $request->validate([
        'fileSCI-202' => 'required|file|mimes:pdf|max:1048'
        
        ]);
        
       
        $file      = $validation['fileSCI-202']; // get the validated file
        $path1      = $file->storeAs('1038/'.$request->id, $nombre1);
        $validation = $request->validate([
        'fileSCI-206' => 'required|file|mimes:pdf|max:1048'
       
        ]);
        
      
        $file      = $validation['fileSCI-206']; // get the validated file        
        $path2      = $file->storeAs('1038/'.$request->id, $nombre2);
        $exists = Storage::disk('local')->exists($path);
        $exists1 = Storage::disk('local')->exists($path1);
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
