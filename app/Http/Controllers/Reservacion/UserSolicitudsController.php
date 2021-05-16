<?php

namespace App\Http\Controllers\Reservacion;

use App\Http\Requests\UserSolicitudsRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\SolicitudReceived;
use App\MAil\ConfirmacionReceived;
use App\Mail\CancelacionReceived;
use App\Solicitud;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserSolicitudsController extends Controller
{
    public function index()
    {
        $solicitud = DB::table('solicituds')
         ->join('users', 'users.id', '=', 'solicituds.user_id')
        ->select('solicituds.id','user_id','solicituds.status',
                'start','end')
        ->where('user_id',auth()->user()->id)
        ->orderBy('start', 'desc')
        ->paginate(7);
        return view('reservas.index', compact('solicitud'));
    }

    public function create()
    {
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;
        return view('reservas.create', compact('user_id','user_name'));
    }

    public function store(UserSolicitudsRequest $request)
    {
        $datosSolicitud = request()->except(['_token','_method','uso']);
        Solicitud::create($datosSolicitud);
        $destinatario = auth()->user()->email;
        $data = Solicitud::latest('id')->first();
        Mail::to($destinatario)->send(new SolicitudReceived($data));
        $data['reservations'] = Solicitud::all();
        return redirect()
       ->route('solicitud.show', $data)
       ->with('message', 'Solicitud Realizada!. -> Notificacion enviada a: '.$destinatario);
    }

    public function show($id)
    {
        
        $solicitud = Solicitud::findOrFail($id);
        
        return view('reservas.show', compact('solicitud'));
    }
    public function calendar()
    {
        $solicitud['request'] = Solicitud::where('status','!=','Cancelado')->get();
        return response()->json($solicitud['request']);
    }

    public function destroy($id){
        $solicitud = Solicitud::findOrFail($id);
        /* $solicitud->delete(); */
        $solicitud->status = "Cancelado";
        $solicitud->save();
        return redirect()
       ->route('solicitud.index')
       ->with('message', 'Solicitud Cancelada!.');
    }

    

    public function store_asoc_cond_vehic(Request $request)
    {
        
       /*  $datosasociacion = request()->except(['_token','_method']);
       
        DB::table('user_vehiculo')->insert($datosasociacion);
      
        return redirect()
       ->route('admin.conductor')
       ->with('message', 'Asociación Realizada!.'); */
    }

    
}
