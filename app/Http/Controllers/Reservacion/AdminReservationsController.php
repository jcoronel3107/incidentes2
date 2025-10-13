<?php

namespace App\Http\Controllers\Reservacion;

use App\Assignment;
use App\Http\Requests\AdminReservationsRequest;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;
use App\Mail\ConfirmacionReceived;
use App\Mail\CancelacionReceived;
use App\Solicitud;
use App\Http\Controllers\Controller;


class AdminReservationsController extends Controller
{


    public function index()
    {
        $solicituds = DB::table('solicituds')
				->join('users',  'solicituds.user_id', '=', 'users.id')
				->select('solicituds.id','title','descripcion','start','end','user_id','users.name','solicituds.status')
				->whereYear('start', '=', date('Y'))
				->whereNull('solicituds.deleted_at')
                ->where('solicituds.status','Solicitado')
                ->paginate(7);
        return view('reservas.admin.index', compact('solicituds'));
    }

    public function edit($id)
    {
        $solicitud = Solicitud::findOrFail( $id );
        $status = Solicitud::$status;
        $ListVehiculosDisponibles = DB::table('vehiculos')
                ->select('id','codigodis','placa','marca','modelo')
                ->where('observacion', 'Servicio')
                ->where('activo','1')
                ->whereNotIn('id',DB::table('assignments')->select('vehiculo_id')->where('estado','En Curso'))
                ->orderByDesc('codigodis')
                ->get();
        $ListConductores = DB::table('users')
                ->select('id','name')
                ->where('cargo', 'maquinista')
                ->where('status','Activo')
                ->whereNull('deleted_at')
                ->orderByDesc('name')
                ->get();
        return view('reservas.admin.edit', compact('solicitud', 'status','ListVehiculosDisponibles','ListConductores'));
    }


    public function update(AdminReservationsRequest $request)
    {

            
            /* Actualiza registro en Tabla Solicituds */
            $solicitud= Solicitud::findOrFail($request->solicitud_id);
            $solicitud->status ="Confirmado";
            $solicitud->save();
/* dd($request); */
            $solicitud->Assignment()->create([
                'color' => $request->color,
                'textColor'=> $request->textColor,
                'start'=> $request->start,
                'end' => $request->end,
                'estado' => "En Curso",
                'vehiculo_id' => $request->vehiculo_id,
                'conductor_id' => $request->conductor_id,
                'solicitud_id' => $request->solicitud_id
            ]);
            $destinatario = $request->email;
            //Mail::to($destinatario,"Sistema Incidentes2 - Modulo Reservación")->send(new ConfirmacionReceived($solicitud));
          
            return back()->with('message', 'Solicitud Actualizada con Exito!. Se envio la notificacion a: '.$destinatario);
    }

    public function grafica()
    {
        $solicitud= Solicitud::select(DB::raw("count(*) as count"))
            ->whereYear('start',date('Y'))
            ->where('status','=','Confirmado')
            ->groupBy(DB::raw("Month(start)"))->pluck('count');

        $solicitudCanceladas= Solicitud::select(DB::raw("count(*) as count"))
            ->whereYear('start',date('Y'))
            ->where('status','=','Cancelado')
            ->groupBy(DB::raw("Month(start)"))->pluck('count');

        $solicitudregistradas= Solicitud::select(DB::raw("count(*) as count"))
            ->whereYear('start',date('Y'))
            ->groupBy(DB::raw("Month(start)"))->pluck('count');

        $solicitudsasistidas = Solicitud::select(DB::raw("count(*) as count"))
            ->whereYear('created_at',date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))->pluck('count');
        return view('admin.grafic',compact("solicitud","solicitudCanceladas","solicitudregistradas","solicitudsasistidas"));
    }

    public function show($id)
    {

    }

    public function conductor()
    {
       /*  $vehiculos = DB::table('vehiculos')
            ->select('id', 'codigodis','placa')
            ->where('observacion','Servicio')
            ->get();
        $users = DB::table('users')
            ->select('name', 'id')
            ->where('cargo','Maquinista')
            ->get();
        $conductores_vehiculos = DB::table('user_vehiculo')
            ->join('vehiculos','vehiculo_id','vehiculos.id')
            ->join('users','user_id','users.id')
            ->select('user_vehiculo.id','vehiculo_id','codigodis','user_id','name','user_vehiculo.activo','user_vehiculo.created_at')
            ->get();
        $now = now();
        $now = $now->toDateTimeString();
        return view('conductor',compact("conductores_vehiculos","vehiculos","users","now")); */
    }

    
}
