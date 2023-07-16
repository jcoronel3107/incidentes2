<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Contrato;
use App\Gasolinera;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;


class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request)
        {
          $busq_denominacion = trim($request->get('busq_denominacion'));
          $busq_fecha = trim($request->get('busq_fecha'));
          $contratos = Contrato::OrderBy('id','desc')
          ->where("denominacion",'LIKE','%'.$busq_denominacion.'%')
          ->where("fecha",'LIKE','%'.$busq_fecha.'%')
          ->paginate(10);
              return view( "contrato.index", compact( "contratos","busq_denominacion","busq_fecha") );
        }
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $gasolineras = Gasolinera::all();
        return view( "contrato.crear",compact('gasolineras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosSolicitud = request()->except(['_token','_method']);
        $movilizacion = Contrato::create($datosSolicitud);
        Session::flash('Registro_Almacenado', "Registro Almacenado con Exito!!!");
        return redirect("contrato");
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
