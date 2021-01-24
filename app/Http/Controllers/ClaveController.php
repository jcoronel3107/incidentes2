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
	          ->paginate(10);
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
		$vehiculos = Vehiculo::orderBy('codigodis','asc')->get();
		$users = DB::table('users')->where([
          ['cargo','=','Bombero'],
        ])
        ->orWhere('cargo','=','maquinista')
        ->orderBy("name",'asc')
        ->get();
		/*$users = User::where('cargo','maquinista')
			->get();*/

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
			
			$clave = new Clave;
			$clave->km_salida = $request->km_salida;
			$clave->km_gasolinera = $request->km_gasolinera;
			$clave->km_llegada = $request->km_llegada;
			$clave->dolares = $request->dolares;
			$clave->galones = $request->galones;
			$clave->combustible = $request->combustible;
			$clave->gasolinera_id = $request->gasolinera_id;
			$clave->user_id = $request->user_id;
			$clave->vehiculo_id = $request->vehiculo_id;;
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
			$vehiculos = Vehiculo::orderBy('codigodis','asc')->get();
			$usuarios = DB::table('users')->where([
          ['cargo','=','Bombero'],
        ])
        ->orWhere('cargo','=','maquinista')
        ->orderBy("name",'asc')
        ->get();
			//$usuarios=User::all();
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
			DB::begintransaction();
          	try
          	{	
				$clave = Clave::findOrFail( $id );
				$clave->update([
								'km_salida' => $request->km_salida,
								'km_gasolinera' => $request->km_gasolinera,
								'km_llegada' => $request->km_llegada,
								'dolares' => $request->dolares,
								'galones' => $request->galones,
								'combustible' => $request->combustible,
								'gasolinera_id' => $request->gasolinera_id,
								'user_id' => $request->user_id,
								'vehiculo_id' => $request->vehiculo_id,
								'Orden'	=> $request->Orden]);
			
				Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
				return redirect( "/clave" );
			}
          	catch(\Exception $e)
          	{
              DB::rollback();
              dd($e);
          	}
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
            $clavesxgasolinera = DB::table('claves')
				->join('gasolineras', 'claves.gasolinera_id', '=', 'gasolineras.id')
                ->select('gasolinera_id','gasolineras.razonsocial', DB::raw('count(gasolinera_id) Nro_Cargas'))
                ->whereYear('claves.created_at', '=', date('Y'))
                ->whereNull('claves.deleted_at')
                ->groupBy('claves.gasolinera_id')
                ->havingRaw('count(claves.gasolinera_id) >= ?',[1])
                ->get();
			
            return view("/clave.grafic",compact("claves","clavesxgasolinera"));
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