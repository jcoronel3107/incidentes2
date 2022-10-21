<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clave;
use App\Incidente;
use App\Gasolinera;
use App\Vehiculo;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\SaveClaveRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\ClavesExport;

use Illuminate\Support\Facades\App;


class ClaveController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	

	

	function index(Request $request) {
		$date = Carbon::now();
		$fechaComoEntero = strtotime($date);
		$mes = date("m", $fechaComoEntero);
		if($request)
        {
	        $query = trim($request->get('searchText'));
	        //
	        $claves = Clave::where("Orden",'LIKE','%'.$query.'%')
	          ->OrderBy('created_at','desc')
	          ->paginate(10);

			  $SumaValClaves= Clave::whereMonth('created_at', $mes)
			  ->whereYear('created_at', '=', date('Y'))
			  ->whereNull('claves.deleted_at')
			  ->sum('dolares');
			  
			  $CountClaves= Clave::whereMonth('created_at', $mes)
			  ->whereYear('created_at', '=', date('Y'))
			  ->whereNull('claves.deleted_at')
			  ->count('id');
	  
			  $gasstationexpenses = Clave::whereMonth('created_at', $mes)
			  ->select('combustible', DB::raw('sum(galones) Glns'))
			  ->whereYear('created_at', '=', date('Y'))
			  ->whereNull('claves.deleted_at')
			  ->groupBy('combustible')->get();
	  
			  $gasaccumulatedmonthly = Clave::whereMonth('created_at', $mes)
			  ->select('combustible', DB::raw('sum(dolares) accumulated_monthly'))
			  ->whereYear('created_at', '=', date('Y'))
			  ->whereNull('claves.deleted_at')
			  ->groupBy('combustible')->get();
			$sidebar = '2';
			  
 			return view( "/clave.index", compact("sidebar","gasaccumulatedmonthly","gasstationexpenses","CountClaves","SumaValClaves", "claves","query" ) );
        }
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$gasolineras = Gasolinera::all();
		
		$vehiculos = Vehiculo::orderBy('codigodis')->where('activo','1')->get();
		$users = DB::table('users')->where([
          ['cargo','=','Bombero'],
        ])
        ->orWhere('cargo','=','maquinista')
        ->orderBy("name",'asc')
        ->get();
		$sidebar = '2';
			return view( "/clave.crear",compact("sidebar","gasolineras","vehiculos","users") );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public

	function store( SaveClaveRequest $request ) {
		
			
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
			$clave->factura = $request->factura;
			$clave->usr_creador = auth()->user()->name;
			$clave->save();
			if ($clave->save()) {
				Session::flash('Registro_Almacenado', "Registro Almacenado con Exito!!!");
				return redirect("/clave");
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
		$clave = Clave::findOrFail( $id );
		$sidebar = '2';
		return view( "clave.show", compact( "clave","sidebar" ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public

	function edit($id) {
		
			$gasolineras = Gasolinera::all();
			$vehiculos = Vehiculo::orderBy('codigodis')->where('activo','1')->get();
			$usuarios = DB::table('users')->where([
          ['cargo','=','Bombero'],
        ])
        ->orWhere('cargo','=','maquinista')
        ->orderBy("name",'asc')
        ->get();
		$sidebar = '2';	
			$claves = Clave::findOrFail( $id );
			return view( "clave.edit", compact("claves","gasolineras","vehiculos","usuarios"));
		
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
		
			DB::begintransaction();
          	try
          	{	
				$clave = Clave::findOrFail( $id );
				$clave->update([
								'created_at' => $request->created_at,
								'km_salida' => $request->km_salida,
								'km_gasolinera' => $request->km_gasolinera,
								'km_llegada' => $request->km_llegada,
								'dolares' => $request->dolares,
								'galones' => $request->galones,
								'combustible' => $request->combustible,
								'gasolinera_id' => $request->gasolinera_id,
								'user_id' => $request->user_id,
								'vehiculo_id' => $request->vehiculo_id,
								'Orden'	=> $request->Orden,
								'factura' => $request->factura,
								'usr_editor' => auth()->user()->name 
							]);
			
				Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
				return redirect( "/clave" );
			}
          	catch(\Exception $e)
          	{
              DB::rollback();
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
		
			$clave = Clave::findOrFail( $id );
			$clave->delete();
			Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
			return redirect( "/clave" );
		/* } else {
			return view( "/auth.login" );
		} */
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
		$date = Carbon::now();
        $date = $date->format('l jS \\of F Y ');
        $clave = Clave::find($id);
        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView('clave.pdf', compact('clave','date'));
        return $dompdf->stream();
	}

	public function gasavailablebalancemonthly($id){
		$gasavailablebalancemonthly = Clave::whereMonth('claves.created_at', date('m'))
			  ->join('gasolineras', 'claves.gasolinera_id', '=', 'gasolineras.id')
			  ->select(DB::raw('(gasolineras.monto_contrato - sum(claves.dolares)) gasavailablebalancemonthly'))
			  ->whereYear('claves.created_at', '=', date('Y'))
			  ->whereNull('claves.deleted_at')
			  ->where('claves.gasolinera_id','=',$id)
			  ->groupBy ('gasolinera_id')
			  ->get();	
		return $gasavailablebalancemonthly;
	}
}