<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\Http\Requests\CreateVehiculoRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Exports\VehiculosExport;
use App\Imports\VehiculosImport;
use Barryvdh\DomPDF\PDF;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function index(Request $request)
    {
        //
		if($request)
        {
          $query = trim($request->get('searchText'));
        //
         $vehiculos = Vehiculo::where("codigodis",'LIKE','%'.$query.'%')
          ->OrderBy('codigodis','asc')
          ->paginate(10);
          return view( "/vehiculo.index", compact( "vehiculos","query" ) );
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
			return view( "/vehiculo.crear" );
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVehiculoRequest $request)
    {
      
			$vehiculo = new Vehiculo;
			$vehiculo->placa = $request->placa;
			$vehiculo->marca = $request->marca;
			$vehiculo->modelo = $request->modelo;
			$vehiculo->clase = $request->clase;
			$vehiculo->tipo = $request->tipo;
			$vehiculo->pais_orig = $request->pais_orig;
			$vehiculo->anio_fab = $request->anio_fab;
			$vehiculo->carroceria = $request->carroceria;
			$vehiculo->color1 = $request->color1;
			$vehiculo->color2 = $request->color2;
			$vehiculo->tonelaje = $request->tonelaje;
			$vehiculo->cilindraje = $request->cilindraje;
			$vehiculo->motor = $request->motor;
			$vehiculo->chasis = $request->chasis;
			$vehiculo->station_id = $request->station_id;
			$vehiculo->estado = $request->estado;
			$vehiculo->activo = $request->activo;
			$vehiculo->codigoinv = $request->codigoinv;
			$vehiculo->responsab = $request->responsab;
			$vehiculo->fechacomp = $request->fechacomp;
			$vehiculo->facturacomp = $request->facturacomp;
			$vehiculo->valorcomp = $request->valorcomp;
			$vehiculo->fechabaja = $request->fechabaja;
			$vehiculo->concepbaja = $request->concepbaja;
			$vehiculo->observacion = $request->observacion;
			$vehiculo->kmmantrut = $request->kmmantrut;
			$vehiculo->usuacrea = $request->usuacrea;
			$vehiculo->usuaedit = $request->usuaedit;
			$vehiculo->codigodis = $request->codigodis;
			$vehiculo->combustible = $request->combustible;
			$vehiculo->save();
			Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
			return redirect( "/vehiculo" );
		
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
		$vehiculo = Vehiculo::findOrFail( $id );
		return view( "vehiculo.show", compact( "vehiculo" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
			$vehiculo = Vehiculo::findOrFail( $id );
			return view( "vehiculo.edit", compact( "vehiculo" ) );
		
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
      
			$vehiculo = Vehiculo::findOrFail( $id );
			$vehiculo->update( $request->all() );
			Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
			return redirect( "/vehiculo" );
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
			$vehiculo = Vehiculo::findOrFail( $id );
			$vehiculo->delete();
			Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
			return redirect( "/vehiculo" );
	
    }

    public function export()
    {
        return Excel::download(new VehiculosExport, 'vehiculos.xlsx');
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new VehiculosImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/vehiculo" );
    }

    public function grafica()
    {
        $vehiculosfabricacion= Vehiculo::select("anio_fab",(DB::raw("count(*) as Cantidad")))->groupBy("anio_fab")->get();
        return view("/vehiculo.grafic",compact("vehiculosfabricacion"));
    }

    public function importar()
    {
      return view("/vehiculo.import");
    }
}
