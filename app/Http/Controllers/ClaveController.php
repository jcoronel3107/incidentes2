<?php

namespace App\ Http\ Controllers;

use Illuminate\ Http\ Request;
use App\ Clave;
use App\ Incidente;
use App\ Gasolinera;
use App\ Vehiculo;
use App\ User;
use Illuminate\ Support\ Facades\Session;
use Maatwebsite\ Excel\ Facades\ Excel;
use App\ Http\ Requests\ SaveClaveRequest;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\ ClavesExport;
use PDF;
use Spatie\Activitylog\Traits\LogsActivity;


class ClaveController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct(){
		$this->middleware('auth');

	}

	public

	function index(Request $request) {


		if($request)
        {
	        $query = trim($request->get('searchText'));
	        //
	        $claves = Clave::where("created_at",'LIKE','%'.$query.'%')
	          ->OrderBy('created_at','desc')
	          ->paginate(7);
 			return view( "/clave.index", compact( "claves","query" ) );
        }
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public

	function create() {
		//
		$gasolineras = Gasolinera::all();
		$vehiculos = Vehiculo::all();

		$users = User::where('cargo','maquinista')
			->get();

		if ( Auth::check() ) {
			return view( "/clave.crear",compact("gasolineras","vehiculos","users") );
		} else {
			return view( "/auth.login" );
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public

	function store( SaveClaveRequest $request ) {
		if ( Auth::check() ) {
			$validated = $request->validated();
			$idgasolinera = DB::table('gasolineras')
			->where('razonsocial', $request->gasolinera_id)
			->value('id');
			$userid = DB::table('users')
			->where('name', $request->user_id)
			->value('id');
			$idvehiculo = DB::table('vehiculos')
			->where('codigodis', $request->vehiculo_id)
			->value('id');
			$clave = new Clave;
			$clave->km_salida = $request->km_salida;
			$clave->km_gasolinera = $request->km_gasolinera;
			$clave->km_llegada = $request->km_llegada;
			$clave->dolares = $request->dolares;
			$clave->galones = $request->galones;
			$clave->combustible = $request->combustible;
			$clave->gasolinera_id = $idgasolinera;
			$clave->user_id = $userid;
			$clave->vehiculo_id = $idvehiculo;
			$clave->Orden = $request->Orden;
			$clave->save();
			
			Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
			return redirect( "/clave" );
		} else {
			return view( "/auth.login" );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public

	function show( $id ) {
		//
		$clave = Clave::findOrFail( $id );
		return view( "clave.show", compact( "clave" ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public

	function edit($id) {
		//
		if ( Auth::check() ) {
			$gasolineras = Gasolinera::all();
			$vehiculos = Vehiculo::all();
			$usuarios=User::all();
			$claves = Clave::findOrFail( $id );
			return view( "clave.edit", compact("claves","gasolineras","vehiculos","usuarios"));
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
	public

	function update( SaveClaveRequest $request , $id ) {
		//
		if ( Auth::check() ) {
				$idgasolinera = DB::table('gasolineras')->where('razonsocial', $request->gasolinera_id)->value('id');
				$userid = DB::table('users')->where('name', $request->user_id)->value('id');
				echo ($userid);
				$idvehiculo = DB::table('vehiculos')->where('codigodis', $request->vehiculo_id)->value('id');
				$clave = Clave::findOrFail( $id );
				$clave->update([
								'km_salida' => $request->km_salida,
								'km_gasolinera' => $request->km_gasolinera,
								'km_llegada' => $request->km_llegada,
								'dolares' => $request->dolares,
								'galones' => $request->galones,
								'combustible' => $request->combustible,
								'gasolinera_id' => $idgasolinera,
								'user_id' => $userid,
								'vehiculo_id' => $idvehiculo,
								'Orden'	=> $request->Orden]);
			//	return $request->km_salida;
			Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
			return redirect( "/clave" );
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
	public

	function destroy( $id ) {
		//
		if ( Auth::check() ) {
			$clave = Clave::findOrFail( $id );
			$clave->delete();
			Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
			return redirect( "/clave" );
		} else {
			return view( "/auth.login" );
		}
	}

	public function grafica()
    {


            $claves= Clave::select(DB::raw("Month(created_at) as Mes,count(id) as count"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->get();
            return view("/clave.grafic",compact("claves"));
    }

    public function export()
    {
        return Excel::download(new ClavesExport, 'claves.xlsx');
    }

    public function downloadPDF($id) {
        $clave = Clave::find($id);
        $pdf = PDF::loadView('clave.pdf', compact('clave'));

        return $pdf->download('clave.pdf');
	}
}