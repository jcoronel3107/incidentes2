<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\Incidente;
use App\Gasolinera;
use App\Vehiculo;
use App\User;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\SaveServicioRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\ServiciosExport;
use Illuminate\Support\Carbon;
use PDF;
use Spatie\Activitylog\Traits\LogsActivity;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   /*  public function __construct(){
        $this->middleware('auth');

    } */

    public function index(Request $request)
    {
        if($request)
        {
            $query = trim($request->get('searchText'));
            //
            $servicios = Servicio::where("created_at",'LIKE','%'.$query.'%')
              ->OrderBy('created_at','desc')
              ->paginate(10);
            return view( "/servicio.index", compact( "servicios","query" ) );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $vehiculos = Vehiculo::orderBy('codigodis')->get();

        $users = User::where('cargo','maquinista')
            ->orWhere('cargo','bombero')
            ->orderBy("name",'asc')
            ->get();

       
       /*  if ( Auth::check() ) { */
            return view( "/servicio.crear",compact("vehiculos","users") );
       /*  } else {
            return view( "/auth.login" );
        } */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveServicioRequest $request)
    {
        /* if ( Auth::check() ) { */
            
            $servicio = new Servicio;
            $servicio->fecha_salida = $request->fecha_salida;
            if($request->fecha_retorno=="")
                $request->fecha_retorno=$request->fecha_salida;
            else
                $servicio->fecha_retorno = $request->fecha_retorno;
            
            $servicio->unidad = $request->unidad;
            $servicio->delegante = $request->delegante;
            $servicio->km_salida = $request->km_salida;
            $servicio->km_retorno = $request->km_retorno;
            $servicio->asunto = $request->asunto;
            $servicio->user_id = $request->user_id;
            $servicio->vehiculo_id = $request->vehiculo_id;
            $servicio->usr_creador = auth()->user()->name;
            $servicio->save();
            if ($servicio->save()) {
                Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
                return redirect( "/servicio" );
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
       $servicio = Servicio::findOrFail( $id );
        return view( "servicio.show", compact( "servicio" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* if ( Auth::check() ) { */
            
            $servicio = Servicio::findOrFail( $id );
            $vehiculos = Vehiculo::orderBy('codigodis')->get();
            $maquinistas = User::where('cargo','maquinista')
            ->orWhere('cargo','bombero')
            ->orderBy("name",'asc')
            ->get();
            
            
            return view( "servicio.edit", compact("servicio","vehiculos","maquinistas"));
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
    public function update(SaveServicioRequest $request, $id)
    {
        /* if ( Auth::check() ) { */
                $servicio = Servicio::findOrFail( $id );
                
                $servicio->update([
                                'fecha_salida' => $request->fecha_salida,
                                'fecha_retorno' => $request->fecha_retorno,                                
                                'delegante' => $request->delegante,
                                'unidad' => $request->unidad,
                                'km_salida' => $request->km_salida,
                                'km_retorno' => $request->km_retorno,
                                'asunto' => $request->asunto,
                                'user_id' => $request->user_id,
                                'vehiculo_id' => $request->vehiculo_id,
                                'usr_editor' => auth()->user()->name 
                            ]);
            
            Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
            return redirect( "/servicio" );
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
        /* if ( Auth::check() ) { */
            $servicio = Servicio::findOrFail( $id );
            $servicio->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/servicio" );
        /* } else {
            return view( "/auth.login" );
        } */
    }

    public function grafica()
    {
            $servicios= Servicio::select(DB::raw("Month(created_at) as Mes,count(id) as count"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->get();
            return view("/servicio.grafic",compact("servicios"));
    }

    public function export()
    {
        return Excel::download(new ServiciosExport, 'servicios.xlsx');
    }

    public function downloadPDF($id) {
        $date = Carbon::now();
        $date = $date->format('l jS \\of F Y ');
        $servicio = Servicio::find($id);
        $pdf = PDF::loadView('servicio.pdf', compact('servicio','date'));

        return $pdf->download('servicio.pdf');
    }
}
