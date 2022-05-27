<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\Http\Requests\CreateVehiculoRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Exports\VehiculosExport;
use App\Imports\VehiculosImport;
use Barryvdh\DomPDF\PDF;

class TallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function index(Request $request)
    {		
        $CantVehiculosOperativos = DB::table('vehiculos')
        ->select('id')
        ->where('observacion', 'Emergencia')
        ->where('activo','1')
        ->where('estado','OPERATIVO')
        ->get()->count();
       

        $CantVehiculosEnMantenimiento = DB::table('vehiculos')
        ->select('id')
        ->where('observacion', 'Emergencia')
        ->where('activo','1')
        ->where('estado','MANTENIMIENTO')
        ->get()->count();
        

        $CantVehiculosReparacion = DB::table('vehiculos')
        ->select('id')
        ->where('observacion', 'Emergencia')
        ->where('activo','1')
        ->where('estado','REPARACION')
        ->get()->count();

        $ListVehiculosOperativos = DB::table('vehiculos')
                ->select('id','codigodis','placa','marca','modelo')
                ->where('observacion', 'Emergencia')
                ->where('activo','1')
                ->where('estado','OPERATIVO')
                ->orderByDesc('codigodis')
                ->get();
               
        
        $ListVehiculosEnMantenimiento = DB::table('vehiculos')
        ->select('id','codigodis','placa','marca','modelo')
        ->where('observacion', 'Emergencia')
        ->where('activo','1')
        ->where('estado','MANTENIMIENTO')
        ->orderByDesc('codigodis')
        ->get();
                
        
        $ListVehiculosReparacion = DB::table('vehiculos')
        ->select('id','codigodis','placa','marca','modelo')
        ->where('observacion', 'Emergencia')
        ->where('activo','1')
        ->where('estado','REPARACION')
        ->orderByDesc('codigodis')
        ->get();
        
        return view('mantenimiento_vehicular.index',compact("CantVehiculosOperativos","CantVehiculosEnMantenimiento","CantVehiculosReparacion","ListVehiculosOperativos","ListVehiculosEnMantenimiento","ListVehiculosReparacion"));
    }


  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
			return view( "/vehiculo.crear" );
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVehiculoRequest $request)
    {
      
			
		
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
		$vehiculo = Vehiculo::findOrFail( $id );
		return view( "vehiculo.show", compact( "vehiculo" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
			$vehiculo = Vehiculo::findOrFail( $id );
			return view( "vehiculo.edit", compact( "vehiculo" ) );
		
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
      
			$vehiculo = Vehiculo::findOrFail( $id );
			$vehiculo->update( $request->all() );
			Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
			return redirect( "/vehiculo" );
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
			$vehiculo = Vehiculo::findOrFail( $id );
			$vehiculo->delete();
			Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
			return redirect( "/vehiculo" );
	
    }

    public function export()
    {
        return Excel::download(new VehiculosExport, 'vehiculos.xlsx');
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new VehiculosImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/vehiculo" );
    }

    public function grafica()
    {
        $vehiculosfabricacion= Vehiculo::select("anio_fab",(DB::raw("count(*) as Cantidad")))->groupBy("anio_fab")->get();
        return view("/vehiculo.grafic",compact("vehiculosfabricacion"));
    }

    public function importar()
    {
      return view("/vehiculo.import");
    }
}
