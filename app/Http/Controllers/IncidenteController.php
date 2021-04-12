<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incidente;
use App\Http\Requests\CreateIncidenteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Exports\IncidentesExport;
use Maatwebsite\Excel\Facades\Excel;

class IncidenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function __construct(){
        $this->middleware('auth');

    } */
    public function index(Request $request)
    {
        //
        if($request)
        {
          $query = trim($request->get('searchText'));
        //
        $incidentes = Incidente::where("nombre_incidente",'LIKE','%'.$query.'%')
          ->OrderBy('tipo_incidente','asc')
          ->paginate(10);
          return view( "/incidente.index", compact( "incidentes","query" ) );
        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		/* if ( Auth::check() ) { */
			return view( "/incidente.crear" );
		/* } else {
			return view( "/auth.login" );
		} */

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateIncidenteRequest $request)
    {
        //
		/* if ( Auth::check() ) { */
			$validated = $request->validated();
			$incidente = new Incidente;
			$incidente->tipo_incidente = $request->tipo_incidente;
			$incidente->nombre_incidente = $request->nombre_incidente;
			$incidente->save();
			Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
			return redirect( "/incidente" );
		/* } else {
			return view( "/auth.login" );
		} */
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
		$incidente = Incidente::findOrFail( $id );
		return view( "incidente.show", compact( "incidente" ) );
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
		/* if ( Auth::check() ) { */
			$incidente = Incidente::findOrFail( $id );
			return view( "incidente.edit", compact( "incidente" ) );
		/* } else {
			return view( "/auth.login" );
		} */
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
		/* if ( Auth::check() ) { */
			$incidente = Incidente::findOrFail( $id );
			$incidente->update( $request->all() );
			Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
			return redirect( "/incidente" );
		/* } else {
			return view( "/auth.login" );
		} */
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
		/* if ( Auth::check() ) { */
			$incidente = Incidente::findOrFail( $id );
			$incidente->delete();
			Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
			return redirect( "/incidente" );
		/* } else {
			return view( "/auth.login" );
		} */
    }

	public function export()
    {
        return Excel::download(new IncidentesExport, 'incidentes.xlsx');
    }
}
