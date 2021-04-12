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
use PDF;
use Illuminate\Support\Facades\Storage;



class InundacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function __construct(){
        $this->middleware('auth');
    } */

    public function index(Request $request)
    {
      
        if($request)
        {
          
          $estacion_id = trim($request->get('estacion_id'));
          $query = trim($request->get('searchText'));
          $inundaciones = Inundacion::where("direccion",'LIKE','%'.$query.'%')
          /* ->where("station_id", "==", $estacion_id) */
          ->OrderBy('fecha','desc')
          ->paginate(15);
		      return view("/inundacion.index", compact( "inundaciones","query"));
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
        $maquinistas = User::where("cargo","Maquinista")
        ->orderBy("name",'asc')
        ->get();
    		$incidentes = Incidente::where("tipo_incidente","10_20")
            ->orderBy("nombre_incidente",'asc')
            ->get();
        return view( "/inundacion.crear", compact( "incidentes","now","estaciones","users","maquinistas", "parroquias","vehiculos") );

    		/* if ( Auth::check() ) {
    			return view( "/inundacion.crear", compact( "incidentes","now","estaciones","users","maquinistas", "parroquias","vehiculos") );
    		} else {
    			return view( "/auth.login" );
    		} */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveInundacionRequest $request)
    {
  		/* if ( Auth::check() )
       { */
          DB::begintransaction();
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
                ->first();
            $maqui = User::findOrFail($request->conductor_id);
            $maqui->inundacions()->attach($id);
            $jefe = User::findOrFail($request->jefeguardia_id);
            $jefe->inundacions()->attach($id);
            $bomb = User::findOrFail($request->bombero_id);
            $bomb->inundacions()->attach($id);
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
                $carro->inundacions()->sync(
                  $id , [
                    'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
                $cont=$cont+1;
              }
              Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
              return redirect( "/inundacion" );
          }
          catch(\Exception $e)
          {
              DB::rollback();
              
          }
  		/* } else {
  			return view( "/auth.login" );
  		} */
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
        /* if ( Auth::check() ) { */
            $conductor_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $bombero_id = DB::table('users')
            ->where('id', $id)
            ->value('name');
            $inundacion = Inundacion::findOrFail( $id );
            $vehiculos = Vehiculo::all();
            $bomberos=User::where('cargo','bombero')
            ->orderBy("name",'asc')
            ->get();
            $maquinistas=User::where('cargo','Maquinista')
            ->orderBy("name",'asc')
            ->get();
            $incidentes = Incidente::where("tipo_incidente","10_20")
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $estaciones = Station::all();
            $parroquias = Parroquia::all();

            return view( "inundacion.edit", compact("inundacion","vehiculos","bomberos","maquinistas","incidentes","estaciones","parroquias"));
        /* } else {
            return view( "/auth.login" );
        } */
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update( SaveInundacionRequest $request , $id ) {
        //
        /* if ( Auth::check() ) { */

          DB::begintransaction();
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
          

            $jefeguardia = User::findOrFail($request->jefeguardia_id);
            $jefeguardia->inundacions()->attach($id);
           
            $bombero = User::findOrFail($request->bombero_id);
            $bombero->inundacions()->attach($id);

            $maqui = User::findOrFail($request->conductor_id);
            $maqui->inundacions()->attach($id);
            $cont=0;
            $nombrevehiculo = $request->get('vehiculo_id');
            $kmsalidavehiculo = $request->get('km_salida');
            $kmllegadavehiculo = $request->get('km_llegada');
            $inundacion->vehiculos()->detach();
            while ($cont < count($nombrevehiculo)) {
                    $carro = Vehiculo::findOrFail($nombrevehiculo[$cont]);
                    $carro->inundacions()->attach(
                    $id , [
                         'km_salida' => $kmsalidavehiculo[$cont],'km_llegada' => $kmllegadavehiculo[$cont]]);
                    $cont=$cont+1;
            }
            Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
            return redirect( "/inundacion" );
          }
          catch(\Exception $e)
          {
              DB::rollback();
              
          }
        /* } else {
            return view( "/auth.login" );
        } */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        /* if ( Auth::check() ) { */
            $inundacion = Inundacion::findOrFail( $id );
            $inundacion->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/inundacion" );
        /* } else {
            return view( "/auth.login" );
        } */
    }

    public function export()
    {
        return Excel::download(new InundacionsExport, 'inundacions.xlsx');
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new InundacionsImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/inundacion" );
    }

    public function grafica()
    {
        $inundaciones= Inundacion::select(DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(DB::raw("Month(fecha)"))->pluck('count');
            return view("/inundacion.grafic",compact("inundaciones"));
    }

    public function importar()
    {
      return view("/inundacion.import");
    }

    public function downloadPDF($id) {
        $date = Carbon::now();
        $date = $date->format('l jS \\of F Y ');
        $inundacion = Inundacion::find($id);
        $pdf = PDF::loadView('inundacion.pdf', compact('inundacion','date'));
        return $pdf->download('inundacion.pdf');
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
