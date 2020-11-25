<?php

namespace App\Http\Controllers;

use Illuminate\ Http\ Request;
use App\ Inundacion;
use App\ Incidente;
use App\ Station;
use App\ User;
use App\ Parroquia;
use App\ Vehiculo;
use App\ Http\ Requests\ SaveInundacionRequest;
use Maatwebsite\ Excel\ Facades\ Excel;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\ Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\ Support\ Facades\Session;
use App\Exports\ InundacionsExport;
use App\Imports\ InundacionsImport;
use PDF;
use Illuminate\Support\Facades\Storage;



class InundacionController extends Controller
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
          $inundaciones = Inundacion::where("fecha",'LIKE','%'.$query.'%')
          ->OrderBy('fecha','desc')
          ->paginate(10);
		      return view( "/inundacion.index", compact( "inundaciones","query" ) );
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
        $vehiculos = Vehiculo::all();
        $users = User::where("cargo","bombero")
        ->orderBy("name",'asc')
        ->get();
        $maquinistas = User::where("cargo","maquinista")
        ->orderBy("name",'asc')
        ->get();
    		$incidentes = Incidente::where("tipo_incidente","10_20")
            ->orderBy("nombre_incidente",'asc')
            ->get();

    		if ( Auth::check() ) {
    			return view( "/inundacion.crear", compact( "incidentes","now","estaciones","users","maquinistas", "parroquias","vehiculos" ) );
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
    public function store(SaveInundacionRequest $request)
    {
  		if ( Auth::check() )
       {
          //try
          //{
            //DB::begintransaction();

            /*$validated = $request->validated();*/
            $inundacion = new Inundacion;

            $incidente_id = DB::table('incidentes')
                  ->where('nombre_incidente', $request->incidente_id)
                  ->value('id');
            $estacion_id = DB::table('stations')
                  ->where('nombre', $request->station_id)
                  ->value('id');
            $parroquia_id = DB::table('parroquias')
                  ->where('nombre', $request->parroquia_id)
                  ->value('id');
            $jefeguardia_id= DB::table('users')
                    ->where('name',$request->jefeguardia_id)
                    ->value('id');
            $conductor_id = DB::table('users')
                ->where('name',$request->conductor_id)
                ->value('id');
            $bombero_id= DB::table('users')
                ->where('name',$request->bombero_id)
                ->value('id');
        		$inundacion->incidente_id = $incidente_id;
        		$inundacion->tipo_escena = $request->tipo_escena;
        		$inundacion->station_id = $estacion_id;
        		$inundacion->fecha = $request->fecha;
        		$inundacion->address = $request->address;
        		$inundacion->parroquia_id = $parroquia_id;
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
            $maqui = User::findOrFail($conductor_id);
            $maqui->inundacions()->attach($id);
            $jefe = User::findOrFail($jefeguardia_id);
            $jefe->inundacions()->attach($id);
            $bomb = User::findOrFail($bombero_id);
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
        if ( Auth::check() ) {
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
            $maquinistas=User::where('cargo','maquinista')
            ->orderBy("name",'asc')
            ->get();
            $incidentes = Incidente::where("tipo_incidente","10_20")
            ->orderBy("nombre_incidente",'asc')
            ->get();
            $estaciones = Station::all();
            $parroquias = Parroquia::all();

            return view( "inundacion.edit", compact("inundacion","vehiculos","bomberos","maquinistas","incidentes","estaciones","parroquias"));
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
    function update( SaveInundacionRequest $request , $id ) {
        //
        if ( Auth::check() ) {

           $jefeguardia_id = DB::table('users')->where('name', $request->jefeguardia_id)->value('id');
           $incidente_id = DB::table('incidentes')->where('nombre_incidente', $request->incidente_id)->value('id');
           $station_id = DB::table('stations')->where('nombre', $request->station_id)->value('id');
           $inundacion = Inundacion::findOrFail( $id );
           $inundacion->update([
                                'incidente_id' => $incidente_id,
                                'tipo_escena' => $request->tipo_escena,
                                'station_id' => $station_id,
                                'fecha' => $request->fecha,
                                'address' => $request->address,
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
          Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
          return redirect( "/inundacion" );
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
            $inundacion = Inundacion::findOrFail( $id );
            $inundacion->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/inundacion" );
        } else {
            return view( "/auth.login" );
        }
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
        $inundaciones= Inundacion::select(\DB::raw("count(*) as count"))->whereYear('fecha',date('Y'))->groupBy(\DB::raw("Month(fecha)"))->pluck('count');
            return view("/inundacion.grafic",compact("inundaciones"));
    }

    public function importar()
    {
      return view("/inundacion.import");
    }

    public function downloadPDF($id) {
        $inundacion = Inundacion::find($id);
        $pdf = PDF::loadView('inundacion.pdf', compact('inundacion'));

        return $pdf->download('inundacion.pdf');
    }

    public function cargar($id)
    {
      return view("/inundacion.carga",compact('id'));
    }

    public function upload(Request $request)
    {

       //obtenemos el campo file definido en el formulario
       /*$files = $request->file('fileSCI');
        $paths  = [];

        foreach ($files as $file) {
          $extension = $file->getClientOriginalExtension();
          $filename  = 'profile-photo-' . time() . '.' . $extension;
          $paths[]   = $file->storeAs('file', $filename);
        }
        dd($paths);*/
       $file201 = $request->file('fileSCI-201');
       $file202 = $request->file('fileSCI-202');
       $file206 = $request->file('fileSCI-206');


       //obtenemos el nombre del archivo

       $nombre = "201.".$file201->getClientOriginalExtension();;
       $nombre1 = "202.".$file202->getClientOriginalExtension();
       $nombre2 = "206A.".$file206->getClientOriginalExtension();
       
       //$lastmodified = Storage::lastModified($nombre);
       
       //$lastmodified = DateTime::createFromFormat("U", $lastmodified);
       //$lastmodified = $lastmodified->format('Y-m-d H:i:s');
       
       //$size = Storage::size($nombre);
       //dd($size);
       $validation = $request->validate([
        'fileSCI-201' => 'required|file|mimes:pdf|max:1048'
        // for multiple file uploads
        // 'photo.*' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);
        
       //indicamos que queremos guardar un nuevo archivo en el disco local
       //dd($validation);
        $file      = $validation['fileSCI-201']; // get the validated file
        $path      = $file->storeAs('1020/'.$request->id, $nombre);
        //dd($path);
        $validation = $request->validate([
        'fileSCI-202' => 'required|file|mimes:pdf|max:1048'
        // for multiple file uploads
        // 'photo.*' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);
        
       //indicamos que queremos guardar un nuevo archivo en el disco local
       //dd($validation);
        $file      = $validation['fileSCI-202']; // get the validated file
        $path1      = $file->storeAs('1020/'.$request->id, $nombre1);
        //dd($path);
        $validation = $request->validate([
        'fileSCI-206' => 'required|file|mimes:pdf|max:1048'
        // for multiple file uploads
        // 'photo.*' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);
        
       //indicamos que queremos guardar un nuevo archivo en el disco local
       //dd($validation);
        $file      = $validation['fileSCI-206']; // get the validated file
        $path2      = $file->storeAs('1020/'.$request->id, $nombre2);
        //dd($path);
        
        $exists = Storage::disk('local')->exists($path);
        $exists1 = Storage::disk('local')->exists($path1);
        $exists2 = Storage::disk('local')->exists($path2);
        if ($exists&&$exists1&&$exists2) {
          Session::flash('Carga_Correcta',"Formularios Subidos con Exito!!!");
         return redirect( "/inundacion" );
        } else {
          Session::flash('Carga_Incorrecta',"Evento Tiene Formularios Cargados con Anterioridad.!!!");
          return redirect( "/inundacion" );
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
