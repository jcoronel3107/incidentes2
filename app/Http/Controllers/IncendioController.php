<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incendio;
use App\Incidente;
use App\Station;
use App\User;
use App\Parroquia;
use App\Vehiculo;
use App\Http\Requests\SaveIncendioRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Exports\IncendiosExport;
use App\Imports\IncendiosImport;
use PDF;
use Illuminate\Support\Facades\Storage;


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
            $incendios = Incendio::where("direccion",'LIKE','%'.$query.'%')
              ->OrderBy('fecha','desc')
              ->paginate(15);
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
        $vehiculos = Vehiculo::orderBy('codigodis')->get();
        $estaciones = Station::all();
        $parroquias = Parroquia::all();
        $incidentes = Incidente::where("tipo_incidente","10_70")
        ->orderBy("nombre_incidente",'asc')
        ->get();
        $maquinistas = User::where("cargo","maquinista")
        ->orderBy("name",'asc')
        ->get();
        $users = DB::table('users')->where([
          ['cargo','=','Bombero'],
        ])
        ->orWhere('cargo','=','Paramedico')
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
            try
            {
                $validated = $request->validated();
                
                $incendio = new Incendio;
                $incendio->incidente_id = $request->incidente_id;
                $incendio->tipo_escena = $request->tipo_escena;
                $incendio->station_id = $request->station_id;
                $incendio->fecha = $request->fecha;
                $incendio->direccion = $request->direccion;
                $incendio->parroquia_id = $request->parroquia_id;
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
                $incendio->usr_creador = auth()->user()->name;
                $incendio->save();
                $id = DB::table('incendios')
                         ->select(DB::raw('max(id) as id'))
                         ->first();
                $maqui = User::findOrFail($request->conductor_id);
                $maqui->incendios()->attach($id);
                $jefe = User::findOrFail($request->jefeguardia_id);
                $jefe->incendios()->attach($id);
                $bomb = User::findOrFail($request->bombero_id);
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
            }
            catch(\Exception $e)
            {
              DB::rollback();
              dd($e);
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
            $vehiculos = Vehiculo::orderBy('codigodis','DESC')->get();
            $bomberos = DB::table('users')->where([
              ['cargo','=','Bombero'],
            ])
            ->orWhere('cargo','=','Paramedico')
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
            DB::begintransaction();
            try
            {         
                $incendio = Incendio::findOrFail( $id );
                $incendio->update([
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

                $incendio->users()->detach();
                $jefeguardia = User::findOrFail($request->jefeguardia_id);
                $jefeguardia->incendios()->attach($id);
                $bombero = User::findOrFail($request->bombero_id);
                $bombero->incendios()->attach($id);
                $maqui = User::findOrFail($request->conductor_id);
                $maqui->incendios()->attach($id);
                $cont=0;
                $nombrevehiculo = $request->get('vehiculo_id');
                $kmsalidavehiculo = $request->get('km_salida');
                $kmllegadavehiculo = $request->get('km_llegada');
                $incendio->vehiculos()->detach();
                while ($cont < count($nombrevehiculo)) {
                    $carro = Vehiculo::findOrFail($nombrevehiculo[$cont]);
                    $carro->incendios()->attach(
                    $id , [
                         'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
                    $cont=$cont+1;
                }
                Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
                return redirect( "/fuego" );
            }
            catch(\Exception $e)
            {
              DB::rollback();
              dd($e);
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
        $incendios= Incendio::select(DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(DB::raw("Month(fecha)"))->pluck('count');
            return view("/fuego.grafic",compact("incendios"));
    }

    public function importar()
    {
      return view("/fuego.import");
    }

    public function downloadPDF($id) {
        $date = Carbon::now();
        $date = $date->format('l jS \\of F Y ');
        $incendio = Incendio::find($id);
        $pdf = PDF::loadView('fuego.pdf', compact('incendio','date'));

        return $pdf->download('incendio.pdf');
    }

    public function cargar($id)
    {
      return view("/fuego.carga",compact('id'));
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
        $path      = $file->storeAs('1070/' . $request->id, $nombre);
        $exists = Storage::disk('local')->exists($path);

        //obtenemos el nombre del archivo
        $file207 = $request->file('fileSCI-207');
        $nombre1 = "207." . $file207->getClientOriginalExtension();
        $validation = $request->validate([
            'fileSCI-207' => 'required|file|mimes:pdf|max:2048'
        ]);
        $file      = $validation['fileSCI-207']; // get the validated file
        $path1      = $file->storeAs('1070/' . $request->id, $nombre1);
        $exists1 = Storage::disk('local')->exists($path1);

        //obtenemos el nombre del archivo
        $file211 = $request->file('fileSCI-211');
        $nombre2 = "211." . $file211->getClientOriginalExtension();
        $validation = $request->validate([
            'fileSCI-211' => 'required|file|mimes:pdf|max:2048'
        ]);
        $file      = $validation['fileSCI-211']; // get the validated file        
        $path2      = $file->storeAs('1070/' . $request->id, $nombre2);
        $exists2 = Storage::disk('local')->exists($path2);
        if ($exists&&$exists1&&$exists2) {
          Session::flash('Carga_Correcta',"Formularios Subidos con Exito!!!");
         return redirect( "/fuego" );
        } else {
          Session::flash('Carga_Incorrecta',"Evento Tiene Formularios Cargados con Anterioridad.!!!");
          return redirect( "/fuego" );
        }
        
        
       /*if ($size>1048576) {
          Session::flash('Tamaño_Excedido',"El tamaño maximo pemitido es de 1 MB por Archivo.!!!".$size/1024);
          return redirect( "/inundacion" );
       } 
       else {
         if (!$exists) {
         \Storage::disk('local')->put($nombre,  \File::get($file201));
         \Storage::disk('local')->put($nombre1,  \File::get($file202));
         \Storage::disk('local')->put($nombre2,  \File::get($file206));
         Session::flash('Carga_Correcta',"Formularios Subidos con Exito!!!");
         return redirect( "/inundacion" );
         }
          else
         {
          
          }
       }*/ 
    }

    
}
