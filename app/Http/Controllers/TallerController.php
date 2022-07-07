<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaveMaintenanceRequest;
use App\Maintenance_request;
use Illuminate\Support\Facades\DB;
use App\Exports\TallerBitacoraExport;
use App\Mail\MaintenanceRequestNotification;
use App\Mecanico;
use App\User;
use App\Vehiculo;
use App\Workorder;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;


class TallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index(Request $request){
        if($request){
            $busq_user = trim($request->get('busq_user'));
            $busq_fecha = trim($request->get('busq_fecha'));
            $busq_status = trim($request->get('busq_status'));
            $mecanicos = Mecanico::all();
            $maintenance_requests = Maintenance_request::OrderBy('id','desc')
          
            ->where('fecha','LIKE','%'.$busq_fecha.'%')
            ->where('status','LIKE','%'.$busq_status.'%')
            ->paginate(10);
        
            return view('mantenimiento_vehicular.index',compact("mecanicos","maintenance_requests","busq_user","busq_fecha","busq_status"));
        }
    }

    public function listworkorder(Request $request){
        if($request){
            $busq_vehiculo = trim($request->get('busq_vehiculo'));
            $busq_fecha = trim($request->get('busq_fecha'));
            $busq_status = trim($request->get('busq_status'));
            $busq_orden = trim($request->get('busq_orden'));
            $work_orders = Workorder::OrderBy('id','desc')
            
            
            ->paginate(10);
           
            return view('mantenimiento_vehicular.list_work_order',compact('work_orders','busq_vehiculo','busq_fecha','busq_status','busq_orden'));
        }
    }

    public function disponibilidad(Request $request){		
        $CantVehiculosOperativos = DB::table('vehiculos')
        ->select('id')
        ->where('activo','1')
        ->where('estado','=','OPERATIVO')
        ->get()->count();
       

        $CantVehiculosEnMantenimiento = DB::table('vehiculos')
        ->select('id')
        ->where('activo','=','1')
        ->where('estado','=','MANTENIMIENTO')
        ->get()->count();
        

        $CantVehiculosReparacion = DB::table('vehiculos')
        ->select('id')
        ->where('activo','1')
        ->where('estado','=','REPARACION')
        ->get()->count();

        $ListVehiculosOperativos = DB::table('vehiculos')
                ->select('id','codigodis','placa','marca','modelo')
                ->where('activo','1')
                ->where('estado','OPERATIVO')
                ->orderByDesc('codigodis')
                ->get();
               
        
        $ListVehiculosEnMantenimiento = DB::table('vehiculos')
        ->select('id','codigodis','placa','marca','modelo')
        ->where('activo','1')
        ->where('estado','=','MANTENIMIENTO')
        ->orderByDesc('codigodis')
        ->get();
                
        
        $ListVehiculosReparacion = DB::table('vehiculos')
        ->select('id','codigodis','placa','marca','modelo')
        ->where('activo','1')
        ->where('estado','=','REPARACION')
        ->orderByDesc('codigodis')
        ->get();
        
        return view('mantenimiento_vehicular.disponibilidad',compact("CantVehiculosOperativos","CantVehiculosEnMantenimiento","CantVehiculosReparacion","ListVehiculosOperativos","ListVehiculosEnMantenimiento","ListVehiculosReparacion"));
    }

    public function EnMantenimiento(string $vehiculo_id){

        Vehiculo::where('id', $vehiculo_id)
              ->where('observacion', 'Emergencia')
              ->where('activo','1')
              ->update(['estado' => 'MANTENIMIENTO']);
    }

    public function EnReparacion(string $vehiculo_id){

        Vehiculo::where('id', $vehiculo_id)
                ->where('observacion', 'Emergencia')
                ->where('activo','1')
                ->update(['estado' => 'REPARACION']);
    }

    public function Operativo(string $vehiculo_id){

        Vehiculo::where('id', $vehiculo_id)
                ->where('observacion', 'Emergencia')
                ->where('activo','1')
                ->update(['estado' => 'OPERATIVO']);
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
    public function store_maintenance_request(SaveMaintenanceRequest $request)
    {
      
        try
        {
          $destinatario = "pereyes@bomberos.gob.ec";
          $maintenance_request = new Maintenance_request;
          
          $maintenance_request->fecha = $request->fecha;
          $maintenance_request->descripcion = $request->descripcion;
          $maintenance_request->user_id = auth()->user()->id;
          $maintenance_request->vehiculo_id = $request->vehiculo;
          $maintenance_request->km_ingreso = $request->km_ingreso;
          $maintenance_request->status = "Solicitado";
          $maintenance_request->save();   
          $data = Maintenance_request::latest('id')->first();
          Mail::to($destinatario)->send(new MaintenanceRequestNotification($data));       
          Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
          return redirect( "/solicitudes" );
        }
        catch(\Exception $e)
        {
            dd($e);
           
        }
		
    }

    public function create_workorder_ajaxRequestPost(Request $request){
        try
        {
            $workorder = new Workorder;
            $workorder->fecha = $request->fecha;
            $workorder->km_ingreso = $request->km_ingreso;
            $workorder->status = $request->status;
            $workorder->maintenance_request_id = $request->maintenance_request_id;
            $workorder->save();
            Maintenance_request::where('id', $request->maintenance_request_id)
              ->update(['status' => 'Asignado']);
            
            return redirect( "/listworkorder" );
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

    public function solicitar_mant()
    {
        $Vehiculoinfo = Vehiculo::select('id','codigodis')
        ->where('activo','=','1')
        ->orderByDesc('codigodis')
        ->get();
        $maquinista = auth()->user()->name;
        $now = Carbon::now();
        return view('mantenimiento_vehicular.solicitar_mant',compact('Vehiculoinfo','maquinista','now'));
    }

    public function consultainfovehiculo($idvehiculo)
    {
        $consultainfovehiculo = Vehiculo::select('id','placa','marca',)
        ->where('id','=',$idvehiculo)
        ->get();
        return $consultainfovehiculo;
    }
}
