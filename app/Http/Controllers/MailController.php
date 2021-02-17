<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inundacion;
use App\Derrame;
use App\Clave;
use App\Rescate;
use App\Incidente;
use App\Station;
use App\User;
use App\Fuga;
use App\Incendio;
use App\Salud;
use App\Parroquia;
use App\Vehiculo;
use App\Servicio;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Mail\ReportSentInundacions;
use App\Mail\ReportSentRescate;
use App\Mail\ReportSentTransito;
use App\Mail\ReportSentSalud;
use App\Mail\ReportSentIncendio;
use App\Mail\ReportSentGas;
use App\Mail\ReportSentClave;
use App\Mail\ReportSentDerrame;
use App\Mail\ReportSentServicio;


class MailController extends Controller
{
	public function __construct(){
		$this->middleware('auth');

	}

    public function SendMailsInundacion($id,Request $request){
        /*$destinatario = auth()->user()->email;*/
        $destinatario = $request->email;
        $data = Inundacion::findOrFail($id);
        Mail::to($destinatario)->send(new ReportSentInundacions($data));
        Session::flash('Envio Mail Correcto',"Reporte Enviado con Exito!!!");
       	return redirect( "/inundacion" );
    }

    public function SendMailsRescate($id,Request $request){
        /*$destinatario = auth()->user()->email;*/
        $destinatario = $request->email;
        $data = Rescate::findOrFail($id);
        Mail::to($destinatario)->send(new ReportSentRescate($data));
        Session::flash('Envio Mail Correcto',"Reporte Enviado con Exito!!!");
        return redirect( "/rescate" );
    }

    public function SendMailsTransito($id,Request $request){
        /*$destinatario = auth()->user()->email;*/
        $destinatario = $request->email;
        $data = Transito::findOrFail($id);
        Mail::to($destinatario)->send(new ReportSentTransito($data));
        Session::flash('Envio Mail Correcto',"Reporte Enviado con Exito!!!");
        return redirect( "/transito" );
    }

    public function SendMailsSalud($id,Request $request){
        /*$destinatario = auth()->user()->email;*/
        $destinatario = $request->email;
        $data = Salud::findOrFail($id);
        Mail::to($destinatario)->send(new ReportSentSalud($data));
        Session::flash('Envio Mail Correcto',"Reporte Enviado con Exito!!!");
        return redirect( "/salud" );
    }

    public function SendMailsIncendio($id,Request $request){
        /*$destinatario = auth()->user()->email;*/
        $destinatario = $request->email;
        $data = Incendio::findOrFail($id);
        Mail::to($destinatario)->send(new ReportSentIncendio($data));
        Session::flash('Envio Mail Correcto',"Reporte Enviado con Exito!!!");
        return redirect( "/incendio" );
    }

    public function SendMailsFuga($id,Request $request){
        $destinatario = $request->email;
        /*$destinatario = auth()->user()->email;*/
        $data = Fuga::findOrFail($id);
        Mail::to($destinatario)->send(new ReportSentGas($data));
        Session::flash('Envio Mail Correcto',"Reporte Enviado con Exito!!!");
        return redirect( "/fuga" );
    }

    public function SendMailsClave($id,Request $request){
        $destinatario = $request->email;
        /*$destinatario = auth()->user()->email;*/
        $data = Clave::findOrFail($id);
        Mail::to($destinatario)->send(new ReportSentClave($data));
        Session::flash('Envio Mail Correcto',"Reporte Enviado con Exito!!!");
        return redirect( "/clave" );
    }

    public function SendMailsDerrame($id,Request $request){
        $destinatario = $request->email;
        /*$destinatario = auth()->user()->email;*/
        $data = Derrame::findOrFail($id);
        Mail::to($destinatario)->send(new ReportSentDerrame($data));
        Session::flash('Envio Mail Correcto',"Reporte Enviado con Exito!!!");
        return redirect( "/derrame" );
    }

    public function SendMailsServicio($id,Request $request){
        $destinatario = $request->email;
        /*$destinatario = auth()->user()->email;*/
        $data = Servicio::findOrFail($id);
        Mail::to($destinatario)->send(new ReportSentServicio($data));
        Session::flash('Envio Mail Correcto',"Reporte Enviado con Exito!!!");
        return redirect( "/servicio" );
    }
}
