<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Exports\TallerBitacoraExport;
use Maatwebsite\Excel\Facades\Excel;


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
        
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
			
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $Listvehiculos = DB::connection('mysql2')->table('v_vehiculos')
        ->select('codigo','codigodis')
        ->orderByDesc('codigodis')
        ->get();
        return view('mantenimiento_vehicular.consulta',compact('Listvehiculos'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
			
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
      
			
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
			
	
    }

    public function export_bitacora(string $fchD,string $fchH, string $vehiculoid,string $aprov,string $liquid)
    {
        return Excel::download(new TallerBitacoraExport($fchD,$fchH,$vehiculoid,$aprov,$liquid), 'export_bitacora.xlsx');
    }

    public function importacion(Request $request)
    {
      
    }

    public function grafica()
    {
        
    }

    public function search_bitacora(Request $request)
    {
        $ListMantenimientosEntreFechas = DB::connection('mysql2')->table('v_mantenimientos')
        ->join('v_vehiculos','v_mantenimientos.vehiculo','=','v_vehiculos.codigo')
        ->join('v_facturas','v_mantenimientos.factura','=','v_facturas.id')
        ->select('numero','referencia','taller','codigodis','v_mantenimientos.estacion','kilometraje','descripcion','usuaemite','fechaemite','aprobado','liquidado','usuaaprueba','total')
        ->where('v_mantenimientos.vehiculo',$request->Vehiculo)
        ->whereBetween('fechaemite',[$request->fechaD, $request->fechaH])
        ->where('aprobado',$request->aprobado)
        ->where('liquidado',$request->liquidado)
        ->orderByDesc('fechaemite')
        ->paginate(10);
        $fechaD = $request->fechaD;
        $fechaH = $request->fechaH;
        $aprobado = $request->aprobado;
        $VehiculoId = $request->Vehiculo;
        $liquidado = $request->liquidado;
        $Vehiculo = $request->Vehiculo;
        
        $Vehiculo = DB::connection('mysql2')->table('v_vehiculos')
        ->select('placa','marca','modelo','codigodis','clase','motor','chasis','anio_fab')
        ->where('codigo',$VehiculoId)
        ->orderByDesc('codigodis')->first();


        return view('mantenimiento_vehicular.view_bitacora',compact('ListMantenimientosEntreFechas','fechaD','fechaH','aprobado','Vehiculo','VehiculoId','liquidado'));
    }
}
