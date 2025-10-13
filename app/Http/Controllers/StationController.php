<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Station;
use App\Http\Requests\CreateStationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Exports\StationsEsport;
use Maatwebsite\Excel\Facades\Excel;


class StationController extends Controller
{
    //
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
        $estaciones = Station::where("nombre",'LIKE','%'.$query.'%')
        ->OrderBy('id','asc')
        ->paginate(3);

        return view( "/estacion.index", compact( "estaciones","query") );
        }
        /*$estaciones = Station::all()
        ->OrderBy('id','asc')
        ->paginate(5);
        return view( "/estacion.index", compact( "estaciones" ) );*/


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
			return view("/estacion.crear");
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
    public function store(CreateStationRequest $request)
    {
        //
		/* if ( Auth::check() ) { */
			//
			$estaciones = new Station;
			$estaciones->nombre = $request->nombre;

			$estaciones->save();
			Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
			return redirect( "/estacion" );
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
		$estaciones = Station::findOrFail( $id );
		return view( "estacion.show", compact( "estaciones" ) );
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
			$estaciones = Station::findOrFail( $id );
			return view( "/estacion.edit", compact( "estaciones" ) );
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
			$estaciones = Station::findOrFail( $id );
			$estaciones->update( $request->all() );
			Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
			return redirect( "/estacion" );
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
			$estaciones = Station::findOrFail( $id );
			$estaciones->delete();
			Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
			return redirect( "/estacion" );
		/* } else {
			return view( "/auth.login" );
		} */
    }

    public function export()
    {
        return Excel::download(new StationsEsport, 'estaciones.xlsx');
    }
}
