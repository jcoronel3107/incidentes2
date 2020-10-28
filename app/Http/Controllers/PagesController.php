<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clave;
use App\ Inundacion;
use App\ Incendio;
use App\ Transito;
use App\ Salud;
use App\ Rescate;
use App\ Fuga;
use App\Derrame;
use App\Servicio;
use App\Http\Requests\CreateClaveRequest;
use Illuminate\Support\Facades\DB;


class PagesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }

    public function index()
    {


    	$carbon = new \Carbon\Carbon();
		$date = $carbon->now();
		$fechaComoEntero = strtotime($date);
		$mes = date("m", $fechaComoEntero);
		//$date = $date->format('l jS \\of F Y h:i:s A');

    	$mensualesInundacion= Inundacion::whereMonth('fecha', $mes)
        ->get()->count();
        $mensualesRescate= Rescate::whereMonth('fecha', $mes)
        ->get()->count();
        $mensualesIncendio= Incendio::whereMonth('fecha', $mes)
        ->get()->count();
        $mensualesSalud= Salud::whereMonth('fecha', $mes)
        ->get()->count();
        $mensualesTransito= Transito::whereMonth('fecha', $mes)
        ->get()->count();
        $mensualesFuga= Fuga::whereMonth('fecha', $mes)
        ->get()->count();
        $mensualesClave= Clave::whereMonth('created_at', $mes)
        ->get()->count();
        $mensualesServicio= Servicio::whereMonth('created_at', $mes)
        ->get()->count();
        $mensualesDerrame= Derrame::whereMonth('created_at', $mes)
        ->get()->count();
    	return view("welcome",compact("mensualesInundacion","mensualesRescate","mensualesIncendio","mensualesSalud","mensualesTransito","mensualesFuga","mensualesClave","mensualesServicio","mensualesDerrame"));
    }
}
