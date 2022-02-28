<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Gasolinera;
use App\Http\Requests\CreateGasolineraRequest;
use Illuminate\Support\Facades\Auth;

class GasolineraController extends Controller
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
          $query = trim($request->get('searchText'));
        $gasolineras = Gasolinera::where("razonsocial",'LIKE','%'.$query.'%')
          ->OrderBy('created_at','asc')
          ->paginate(5);
          return view( "/gasolinera.index", compact( "gasolineras","query" ) );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
			return view( "/gasolinera.crear");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGasolineraRequest $request)
    {
			$validated = $request->validated();
			$gasolinera = new Gasolinera;
			$gasolinera->razonsocial = $request->razonsocial;
			$gasolinera->ruc = $request->ruc;
			$gasolinera->direccion = $request->direccion;
			$gasolinera->email = $request->email;
      $gasolinera->monto_contrato = $request->monto_contrato;
			$gasolinera->save();
			Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
			return redirect( "/gasolinera" );
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @4return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$gasolinera = Gasolinera::findOrFail( $id );
		return view( "gasolinera.show", compact( "gasolinera" ) );
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
		if ( Auth::check() ) {
			$gasolinera = Gasolinera::findOrFail( $id );
			return view( "/gasolinera.edit", compact( "gasolinera" ) );
		} else {
			return view( "/auth.login" );
		}
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
			$gasolinera = Gasolinera::findOrFail( $id );
			$gasolinera->update( $request->all() );
			Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
			return redirect( "/gasolinera" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
			$gasolinera = Gasolinera::findOrFail( $id );
			$gasolinera->delete();
			Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
			return redirect( "/gasolinera" );
    }
}
