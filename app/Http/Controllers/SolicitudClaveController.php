<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Gasolinera;
use App\Http\Requests\UserSolicitudsRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\SolicitudReceived;
use App\Mail\ConfirmacionReceived;
use App\Mail\CancelacionReceived;
use App\Solicitud;
use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


use Carbon\Carbon;



class SolicitudClaveController extends Controller
{
    public function index(Request $request)
    {
        $date = Carbon::now();
		$fechaComoEntero = strtotime($date);
		$mes = date("m", $fechaComoEntero);
		if($request)
        {
	        $query_orden = trim($request->get('busq_x_orden'));
            $query_conductor = trim($request->get('busq_x_conductor'));
            $query_vehiculo = trim($request->get('busq_x_vehiculo'));
            $query_fecha = trim($request->get('busq_x_fecha'));

            $solicituds = Solicitud::orderBy('solicituds.created_at','desc')
            ->join('users', 'users.id', '=', 'solicituds.user_id')
            ->join('vehiculos','vehiculos.id','=','solicituds.vehiculo_id')
            ->join('gasolineras','gasolineras.id','=','solicituds.gasolinera_id')
            ->select('solicituds.id','user_id','solicituds.status','vehiculo_id','solicituds.combustible','solicituds.created_at','gasolineras.razonsocial')
            ->where("solicituds.id",'LIKE','%'.$query_orden.'%')
            ->where("codigodis",'LIKE','%'.$query_vehiculo.'%')
            ->where("solicituds.created_at",'LIKE','%'.$query_fecha.'%')
            
            ->paginate(10);
           
            return view('/clave/solicitud.index', compact('solicituds','query_orden','query_conductor','query_vehiculo','query_fecha'));
        }
    }

    /*public function authorize_index(Request $request)
    {
        $date = Carbon::now();
		$fechaComoEntero = strtotime($date);
		$mes = date("m", $fechaComoEntero);
		if($request)
        {
	        $query_orden = trim($request->get('busq_x_orden'));
            $query_conductor = trim($request->get('busq_x_conductor'));
            $query_vehiculo = trim($request->get('busq_x_vehiculo'));
            $query_fecha = trim($request->get('busq_x_fecha'));

            $solicituds = Solicitud::orderBy('solicituds.created_at','desc')
            ->join('users', 'users.id', '=', 'solicituds.user_id')
            ->join('vehiculos','vehiculos.id','=','solicituds.vehiculo_id')
            ->join('gasolineras','gasolineras.id','=','solicituds.gasolinera_id')
            ->select('solicituds.id','user_id','solicituds.status','vehiculo_id','solicituds.created_at','gasolineras.razonsocial')
            ->where("solicituds.id",'LIKE','%'.$query_orden.'%')
            ->where("codigodis",'LIKE','%'.$query_vehiculo.'%')
            ->where("solicituds.created_at",'LIKE','%'.$query_fecha.'%')
            ->where('user_id',auth()->user()->id)
            ->paginate(10);
           
            return view('/clave/solicitud.authorized', compact('solicituds','query_orden','query_conductor','query_vehiculo','query_fecha'));
        }
    }*/


    public function create()
    {
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;
        $gasolineras = Gasolinera::all();
        $vehiculos = Vehiculo::all();
        return view('/clave/solicitud.crear', compact('user_id','user_name','gasolineras','vehiculos'));
    }

    public function store(UserSolicitudsRequest $request)
    {
        $datosSolicitud = request()->except(['_token','_method','Enviar']);
        
        Solicitud::create($datosSolicitud);
        $destinatario = "jcoronel@bomberos.gob.ec";
        $data = Solicitud::latest('id')->first();
        Mail::to($destinatario)->send(new SolicitudReceived($data));
        $data['reservations'] = Solicitud::all();
        return redirect()
       ->route('solicitud.show', $data)
       ->with('message', 'Solicitud Realizada!. -> Notificacion enviada a: '.$destinatario);
    }

    public function edit ($id)
    {
        
        $gasolineras = Gasolinera::all();
        $vehiculos = Vehiculo::all();
        $solicituds = Solicitud::findOrFail($id);
       
        return view( "/clave/solicitud.edit", compact("solicituds",'gasolineras','vehiculos'));
        

    }

    public function update(Request $request, $id)
    {
        try
        {
          $solicitud = Solicitud::findOrFail( $id );
          $solicitud->update([
                              'vehiculo_id' => $request->vehiculo_id,
                              'user_id' => auth()->user()->id,
                              'gasolinera_id' => $request->gasolinera_id,
                              'combustible' => $request->combustible
                           ]);
          Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
          return redirect( "solicitud" );
        }
        catch(\Exception $e)
        {
           dd($e);
          
        }
    }

    public function show($id)
    {
        $solicitud = Solicitud::findOrFail($id);        
        return view('clave/solicitud.show', compact('solicitud'));
    }

    public function calendar()
    {
        $solicitud['request'] = Solicitud::where('status','!=','Cancelado')->get();
        return response()->json($solicitud['request']);
    }

    public function destroy($id){
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->status = "Cancelado";
        $solicitud->save();
        $destinatario = "jcoronel@bomberos.gob.ec";
        
        Mail::to($destinatario)->send(new CancelacionReceived($solicitud));
        return redirect()
       ->route('solicitud.index')
       ->with('message', 'Solicitud Cancelada!.');
    }

    public function application_closed(){
        
        $user_id = auth()->user()->id;
        $assignment = Assignment::findOrFail($user_id);
        
        return view('reservas.conductor',compact('user_id','assignment'));
    }

    public function downloadPDF($id) {
        $date = Carbon::now();
        $date = $date->format('l jS \\of F Y ');
        $solicitud = Solicitud::find($id);
        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView('clave/solicitud.pdf', compact('solicitud','date'));
        return $dompdf->stream();

      }

      public function authorize_request(Request $request, $id)
    {
        try
        {
          $solicitud = Solicitud::findOrFail( $id );
          $destinatario = auth()->user()->email;
          $solicitud->update([
                              'status' => 'Confirmado',
                           ]);
          
          Mail::to($destinatario)->send(new ConfirmacionReceived($solicitud));
          Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
          return redirect( "solicitud" );
        }
        catch(\Exception $e)
        {
           dd($e);
          
        }
    }
}
