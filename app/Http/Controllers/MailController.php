<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inundacion;
use App\Derrame;
use App\Clave;
use App\Rescate;
use App\Fuga;
use App\Incendio;
use App\Transito;
use App\Salud;
use App\Servicio;
use Illuminate\Support\Facades\Mail;
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
use App\Mail\ReportSentPrevencion;
use App\Mail\ReportSentBitacoraMantVeh;
use App\Movilizacion;

class MailController extends Controller
{
	public function SendMailsBitacoraMantVeh($id,Request $request){
        
        $destinatario = $request->email;
        $data = Inundacion::findOrFail($id);
        
        Mail::to($destinatario)->send(new ReportSentBitacoraMantVeh($data));
        Session::flash('Envio Mail Correcto',"Reporte Enviado con Exito!!!");
       	return redirect( "/search_bitacora" );
    }

    public function SendMailsInundacion($id,Request $request){
        
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
        $data = Servicio::findOrFail($id);
        Mail::to($destinatario)->send(new ReportSentServicio($data));
        Session::flash('Envio Mail Correcto',"Reporte Enviado con Exito!!!");
        return redirect( "/servicio" );
    }

    public function SendMailsPrevencion($id,Request $request){
        $destinatario = $request->email;
        $data = Movilizacion::findOrFail($id);
        
        Mail::to($destinatario)->send(new ReportSentPrevencion($data));
        Session::flash('Envio Mail Correcto',"Reporte Enviado con Exito!!!");
        return redirect( "/prevencion" );
    }
}
