<?php

namespace App\Http\Controllers;

use Illuminate\ Http\ Request;
use App\ Rescate;
use App\ Incidente;
use App\ Station;
use App\ User;
use App\ Parroquia;
use App\ Vehiculo;
use App\ Http\ Requests\ SaveRescateRequest;
use Maatwebsite\ Excel\ Facades\ Excel;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\ Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\ Support\ Facades\Session;
use App\Exports\ RescatesExport;
use App\Imports\ RescatesImport;
use PDF;
use Illuminate\Support\Facades\Storage;


class RescateController extends Controller
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
          $rescates = Rescate::where("direccion",'LIKE','%'.$query.'%')
          ->OrderBy('fecha','desc')
          ->paginate(15);
		      return view( "/rescate.index", compact( "rescates","query" ) );
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
        $bomberos = DB::table('users')->where([
          ['cargo','=','Bombero'],
        ])
        ->orWhere('cargo','=','Paramedico')
        ->orderBy("name",'asc')
        ->get();
        $maquinistas = User::where("cargo","maquinista")
        ->orderBy("name",'asc')
        ->get();
    		$incidentes = Incidente::where("tipo_incidente","10_33")
            ->orderBy("nombre_incidente",'asc')
            ->get();

    		if ( Auth::check() ) {
    			return view( "/rescate.crear", compact( "incidentes","now","estaciones","bomberos","maquinistas", "parroquias","vehiculos" ) );
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
    public function store(SaveRescateRequest $request)
    {
  		if ( Auth::check() )
       {
          DB::begintransaction();
          try
          {
          
              $validated = $request->validated();
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
                ->first();
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
                  $vehiculo_id = DB::table('vehiculos')
                    ->where('codigodis',$nombrevehiculo[$cont])
                    ->value('id');
                  $carro = vehiculo::findOrFail($vehiculo_id);
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
        if ( Auth::check() )
       {
            $rescate = Rescate::findOrFail( $id );
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
            $incidentes = Incidente::where("tipo_incidente","10_33")
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $estaciones = Station::all();
            $parroquias = Parroquia::all();

            return view( "rescate.edit", compact("rescate","vehiculos","bomberos","maquinistas","incidentes","estaciones","parroquias"));
          
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
    function update(SaveRescateRequest $request , $id ) {
        //
        if ( Auth::check() ) {

          DB::begintransaction();
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
            Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
            return redirect( "/rescate" );
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
    public function destroy($id)
    {
        //
        if ( Auth::check() ) {
            $rescate = Rescate::findOrFail( $id );
            $rescate->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/rescate" );
        } else {
            return view( "/auth.login" );
        }
    }

    public function export()
    {
        return Excel::download(new RescatesExport, 'rescates.xlsx');
    }

    public function grafica()
    {
        $rescates= Rescate::select(\DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(\DB::raw("Month(fecha)"))->pluck('count');
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
        $rescate = Rescate::find($id);
        $pdf = PDF::loadView('rescate.pdf', compact('rescate'));
        return $pdf->download('rescate.pdf');


    }

    public function cargar($id)
    {
      return view("/rescate.carga",compact('id'));
    }

    public function upload(Request $request)
    {
       $file201 = $request->file('fileSCI-201');
       $file202 = $request->file('fileSCI-202');
       $file206 = $request->file('fileSCI-206');


       //obtenemos el nombre del archivo

       $nombre = "201.".$file201->getClientOriginalExtension();
       $nombre1 = "202.".$file202->getClientOriginalExtension();
       $nombre2 = "206A.".$file206->getClientOriginalExtension();
       
       $validation = $request->validate([
        'fileSCI-201' => 'required|file|mimes:pdf|max:1048'
        
        ]);
        
      
        $file      = $validation['fileSCI-201']; // get the validated file        
        $path      = $file->storeAs('1033/'.$request->id, $nombre);
        $validation = $request->validate([
        'fileSCI-202' => 'required|file|mimes:pdf|max:1048'
        
        ]);
        
       
        $file      = $validation['fileSCI-202']; // get the validated file
        $path1      = $file->storeAs('1033/'.$request->id, $nombre1);
        $validation = $request->validate([
        'fileSCI-206' => 'required|file|mimes:pdf|max:1048'
       
        ]);
        
      
        $file      = $validation['fileSCI-206']; // get the validated file        
        $path2      = $file->storeAs('1033/'.$request->id, $nombre2);
        $exists = Storage::disk('local')->exists($path);
        $exists1 = Storage::disk('local')->exists($path1);
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
