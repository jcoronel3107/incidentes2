<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parroquia;
use App\Http\Requests\CreateParroquiaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Exports\ParroquiasExport;
use Maatwebsite\Excel\Facades\Excel;

class ParroquiaController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');

    }
public function index(Request $request)
    {
        //
        if($request)
        {
          $query = trim($request->get('searchText'));
        //
        $parroquias = Parroquia::where("nombre",'LIKE','%'.$query.'%')
          ->OrderBy('nombre','asc')
          ->paginate(5);
          return view( "/parroquia.index", compact( "parroquias","query" ) );
        }



    }

    public function create()
    {
        //
		if ( Auth::check() ) {
			return view( "/parroquia.crear" );
		} else {
			return view( "/auth.login" );
		}

    }

    public function store(CreateParroquiaRequest $request)
    {
        //
		if ( Auth::check() ) {
			//

			$parroquia = new Parroquia;
			$parroquia->nombre = $request->nombre;
      $parroquia->Postalcode = $request->Postalcode;
			$parroquia->save();
			Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
			return redirect( "/parroquia" );
		} else {
			return view( "/auth.login" );
		}
    }

    public function show($id)
    {
        //
		$parroquia = Parroquia::findOrFail( $id );
		return view( "parroquia.show", compact( "parroquia" ) );
    }

    public function edit($id)
    {
        //
		if ( Auth::check() ) {
			$parroquia = Parroquia::findOrFail( $id );
			return view( "parroquia.edit", compact( "parroquia" ) );
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
        //
		if ( Auth::check() ) {
			$parroquia = Parroquia::findOrFail( $id );
			$parroquia->update( $request->all() );
			Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
			return redirect( "/incidente" );
		} else {
			return view( "/auth.login" );
		}
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
		if ( Auth::check() ) {
			$parroquia = Parroquia::findOrFail( $id );
			$parroquia->delete();
			Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
			return redirect( "/parroquia" );
		} else {
			return view( "/auth.login" );
		}
    }

	public function export()
    {
        return Excel::download(new ParroquiasExport, 'parroquias.xlsx');
    }

}
