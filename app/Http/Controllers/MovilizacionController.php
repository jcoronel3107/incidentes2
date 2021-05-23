<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Actividad;
use App\Vehiculo;
use App\User;
use App\Movilizacion;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use App\Http\Requests\SaveMovilizacionRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActUsuario_Entre_FechasExport;
use App\Exports\ActVehiculos_Entre_FechasExport;
use App\Exports\ActInspectores_Entre_FechasExport;
use App\Exports\MovilizacionsExport;

class MovilizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vehiculos = Vehiculo::orderBy('codigodis')->where('activo', '1')->get();
        $users = User::where('cargo','=','inspector')
            ->orWhere('cargo','Jefe Prevencion')
            ->orWhere('cargo','Tecnico Prevencion')
            ->orderBy("name", 'asc')
            ->get();
        if ($request) {
            $busq_user = trim($request->get('busq_user_id'));
            $busq_vehiculo = trim($request->get('busq_vehiculo_id'));
            $busq_fecha = trim($request->get('busq_fecha'));
        
            $movilizacions = Movilizacion::OrderBy('id','desc')
            ->where("user_id",'LIKE','%'.$busq_user.'%')
            ->where("vehiculo_id",'LIKE','%'.$busq_vehiculo.'%')
            ->where("fecha_salida",'LIKE','%'.$busq_fecha.'%')
            ->paginate(10);
            return view("prevencion.index", compact("users","movilizacions", "vehiculos","busq_user","busq_vehiculo","busq_fecha"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehiculos = Vehiculo::orderBy('codigodis')->where('activo', '1')->get();
        $users = User::where('cargo','=','inspector')
            ->orWhere('cargo','Jefe Prevencion')
            ->orWhere('cargo','Tecnico Prevencion')
            ->orderBy("name", 'asc')
            ->get();
        return view("/prevencion.crear", compact("vehiculos", "users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveMovilizacionRequest $request)
    {
        $datosSolicitud = request()->except(['_token','_method']);
        $movilizacion = Movilizacion::create($datosSolicitud);

        /* $id = DB::table('movilizacions')
            ->select(DB::raw('max(id) as id'))
            ->value('id'); */
        $detalle_filtrado = Arr::where($request->detalle, function ($value, $key) {
            return is_string($value);
        });
        [$keys, $values] = Arr::divide($detalle_filtrado);
        for ($i = 0; $i < count($request->actividad); $i++) {
            /* $actividad = new Actividad;
            $actividad->descripcion = $request->actividad[$i];
            $actividad->detalle = $values[$i];
            $actividad->movilizacion_id = $id;
            $actividad->save(); */
            $movilizacion->actividad()->create([
                'descripcion' => $request->actividad[$i],
                'detalle' => $values[$i]
            ]);
        }
        Session::flash('Registro_Almacenado', "Registro Almacenado con Exito!!!");
        return redirect("/prevencion");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $movilizacion = Movilizacion::findOrFail( $id );
		return view( "prevencion.show", compact( "movilizacion" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movilizacion = Movilizacion::findOrFail( $id );
            $movilizacion->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/prevencion" );
    }

    public function downloadPDF($id) {
        $date = Carbon::now();
        $date = $date->format('l jS \\of F Y ');
        $movilizacion = Movilizacion::find($id);
        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView('prevencion.pdf', compact('movilizacion','date'));
        return $dompdf->stream();
    }

    public function consultaentrefechas()	{
		$vehiculos = Vehiculo::orderBy('codigodis')->where('activo', '1')->get();
        $users = User::where('cargo', 'Inspector')
            ->orWhere('cargo','Jefe Prevencion')
            ->orWhere('cargo','Tecnico Prevencion')
            ->orderBy("name", 'asc')
            ->get();
        return view("prevencion.consulta", compact("vehiculos", "users"));
	}

    public function busquedaentrefechas(Request $request)
	{
        if($request)
		$fechaD = $request->fechaD;
		$fechaH = $request->fechaH;
        $conductor = $request->usuario;
        $vehiculo = $request->vehiculo;
        $tabla = "movilizacions";
        if(($vehiculo!='Ninguno')&&($conductor=='Ninguno')){
            $conductor = null;
            $username="";
            $vehiculoname = Vehiculo::findOrFail($vehiculo);
            $cant_actividades_usuario_entre_fechas = DB::table('movilizacions')
            ->join('actividads','movilizacion_id','=','movilizacions.id')
            ->select('descripcion', DB::raw('count(descripcion) Cant_actividad'))
            ->where('user_id','=',$conductor)
            ->whereNull('movilizacions.deleted_at')
            ->whereBetween('fecha_salida', array($fechaD, $fechaH))
            ->whereYear('fecha_salida', '=', date('Y'))
            ->groupBy('descripcion')
			->havingRaw('count(Cant_actividad) >= ?', [1])
			->get();
            $cant_actividades_vehiculo_entre_fechas = DB::table('movilizacions')
            ->join('actividads','movilizacion_id','=','movilizacions.id')
            ->join('vehiculos','vehiculo_id','=','vehiculos.id')
            ->select('descripcion',DB::raw('count(descripcion) Cant_actividad'))
            ->where('vehiculo_id','=',$vehiculo)
            ->whereNull('movilizacions.deleted_at')
            ->whereBetween('fecha_salida', array($fechaD, $fechaH))
            ->whereYear('fecha_salida', '=', date('Y'))
            ->groupBy('descripcion')
			->havingRaw('count(Cant_actividad) >= ?', [1])
			->get();
            $cant_actividades_todosusuario_entre_fechas = DB::table('movilizacions')
            ->join('actividads','movilizacion_id','=','movilizacions.id')
            ->select('descripcion', DB::raw('count(descripcion) Cant_actividad'))
            ->whereNull('movilizacions.deleted_at')
            ->whereBetween('fecha_salida', array($fechaD, $fechaH))
            ->whereYear('fecha_salida', '=', date('Y'))
            ->groupBy('descripcion')
			->havingRaw('count(Cant_actividad) >= ?', [1])
			->get();
        }
        elseif(($vehiculo=='Ninguno')&&($conductor!='Ninguno')){
            $vehiculo =null;
            $vehiculoname="";
            $username = User::findOrFail($conductor);
            $cant_actividades_usuario_entre_fechas = DB::table('movilizacions')
            ->join('actividads','movilizacion_id','=','movilizacions.id')
            ->select('descripcion', DB::raw('count(descripcion) Cant_actividad'))
            ->where('user_id','=',$conductor)
            ->whereNull('movilizacions.deleted_at')
            ->whereBetween('fecha_salida', array($fechaD, $fechaH))
            ->whereYear('fecha_salida', '=', date('Y'))
            ->groupBy('descripcion')
			->havingRaw('count(Cant_actividad) >= ?', [1])
			->get();
            $cant_actividades_vehiculo_entre_fechas = DB::table('movilizacions')
            ->join('actividads','movilizacion_id','=','movilizacions.id')
            ->join('vehiculos','vehiculo_id','=','vehiculos.id')
            ->select('descripcion',DB::raw('count(descripcion) Cant_actividad'))
            ->where('vehiculo_id','=',$vehiculo)
            ->whereNull('movilizacions.deleted_at')
            ->whereBetween('fecha_salida', array($fechaD, $fechaH))
            ->whereYear('fecha_salida', '=', date('Y'))
            ->groupBy('descripcion')
			->havingRaw('count(Cant_actividad) >= ?', [1])
			->get();
            $cant_actividades_todosusuario_entre_fechas = DB::table('movilizacions')
            ->join('actividads','movilizacion_id','=','movilizacions.id')
            ->select('descripcion', DB::raw('count(descripcion) Cant_actividad'))
            ->whereNull('movilizacions.deleted_at')
            ->whereBetween('fecha_salida', array($fechaD, $fechaH))
            ->whereYear('fecha_salida', '=', date('Y'))
            ->groupBy('descripcion')
			->havingRaw('count(Cant_actividad) >= ?', [1])
			->get();
        }else{
           
            $vehiculoname = Vehiculo::findOrFail($vehiculo);
            $username = User::findOrFail($conductor);
            $cant_actividades_usuario_entre_fechas = DB::table('movilizacions')
            ->join('actividads','movilizacion_id','=','movilizacions.id')
            ->select('descripcion', DB::raw('count(descripcion) Cant_actividad'))
            ->where('user_id','=',$conductor)
            ->whereNull('movilizacions.deleted_at')
            ->whereBetween('fecha_salida', array($fechaD, $fechaH))
            ->whereYear('fecha_salida', '=', date('Y'))
            ->groupBy('descripcion')
			->havingRaw('count(Cant_actividad) >= ?', [1])
			->get();
            $cant_actividades_vehiculo_entre_fechas = DB::table('movilizacions')
            ->join('actividads','movilizacion_id','=','movilizacions.id')
            ->join('vehiculos','vehiculo_id','=','vehiculos.id')
            ->select('descripcion',DB::raw('count(descripcion) Cant_actividad'))
            ->where('vehiculo_id','=',$vehiculo)
            ->whereNull('movilizacions.deleted_at')
            ->whereBetween('fecha_salida', array($fechaD, $fechaH))
            ->whereYear('fecha_salida', '=', date('Y'))
            ->groupBy('descripcion')
			->havingRaw('count(Cant_actividad) >= ?', [1])
			->get();
            $cant_actividades_todosusuario_entre_fechas = DB::table('movilizacions')
            ->join('actividads','movilizacion_id','=','movilizacions.id')
            ->select('descripcion', DB::raw('count(descripcion) Cant_actividad'))
            ->whereNull('movilizacions.deleted_at')
            ->whereBetween('fecha_salida', array($fechaD, $fechaH))
            ->whereYear('fecha_salida', '=', date('Y'))
            ->groupBy('descripcion')
			->havingRaw('count(Cant_actividad) >= ?', [1])
			->get();
        }   
		return view("prevencion.entrefechas", compact('vehiculo','conductor','username','tabla','vehiculoname','cant_actividades_todosusuario_entre_fechas','cant_actividades_usuario_entre_fechas','cant_actividades_vehiculo_entre_fechas','fechaD','fechaH'));
	}

    public function export()
	{
		return Excel::download(new MovilizacionsExport, 'consulta_Movilizacion.xlsx');
	}

    public function export1($user,$fechaD,$fechaH)
	{
		return Excel::download(new ActUsuario_Entre_FechasExport($user,$fechaD,$fechaH), 'consulta_Movilizacion'.$fechaD.'_a_'.$fechaH.'.xlsx');
	}

    public function export2($vehiculo,$fechaD,$fechaH)
	{
		return Excel::download(new ActVehiculos_Entre_FechasExport($vehiculo,$fechaD,$fechaH), 'consulta_Movilizacion'.$fechaD.'_a_'.$fechaH.'.xlsx');
	}

    public function export3($fechaD,$fechaH)
	{
		return Excel::download(new ActInspectores_Entre_FechasExport($fechaD,$fechaH), 'consulta_Movilizacion'.$fechaD.'_a_'.$fechaH.'.xlsx');
	}

    public function grafica()
    {
            $movilizacions= Movilizacion::select(DB::raw("Month(fecha_salida) as Mes,count(id) as count"))->whereYear('fecha_salida',date('Y'))->whereNull('deleted_at')->groupBy(DB::raw("Month(fecha_salida)"))->get();
            return view("/prevencion.grafic",compact("movilizacions"));
    }


	
}


