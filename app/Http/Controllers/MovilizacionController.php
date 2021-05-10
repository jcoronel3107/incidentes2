<?php

namespace App\Http\Controllers;

use App\Actividad;
use Illuminate\Http\Request;
use App\Vehiculo;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Movilizacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class MovilizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $movilizacions = Movilizacion::where("created_at", 'LIKE', '%' . $query . '%')
                ->OrderBy('created_at', 'desc')
                ->paginate(10);
            return view("prevencion.index", compact("movilizacions", "query"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehiculos = Vehiculo::orderBy('codigodis')->where('activo', '1')->get();
        $users = User::where('cargo', 'Inspector')
            ->orderBy("name", 'asc')
            ->get();
        return view("/prevencion.crear", compact("vehiculos", "users"));
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
        //dd($datosSolicitud);
        Movilizacion::create($datosSolicitud);
        $id = DB::table('movilizacions')
            ->select(DB::raw('max(id) as id'))
            ->value('id');
        $detalle_filtrado = Arr::where($request->detalle, function ($value, $key) {
            return is_string($value);
        });
        [$keys, $values] = Arr::divide($detalle_filtrado);

       /*  dd($request->actividad); */
        for ($i = 0; $i < count($request->actividad); $i++) {

            $actividad = new Actividad;
            $actividad->descripcion = $request->actividad[$i];
            $actividad->detalle = $values[$i];
            $actividad->movilizacion_id = $id;
            $actividad->save();
        }
        Session::flash('Registro_Almacenado', "Registro Almacenado con Exito!!!");
        return redirect("/prevencion");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $movilizacion = Movilizacion::findOrFail( $id );
		return view( "prevencion.show", compact( "movilizacion" ) );
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

    public function downloadPDF($id) {
        $date = Carbon::now();
        $date = $date->format('l jS \\of F Y ');
        $movilizacion = Movilizacion::find($id);
        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView('prevencion.pdf', compact('movilizacion','date'));
        return $dompdf->stream();
      }

      public function consultaentrefechas()	{
		$vehiculos = Vehiculo::orderBy('codigodis')->where('activo', '1')->get();
        $users = User::where('cargo', 'Inspector')
            ->orderBy("name", 'asc')
            ->get();
        return view("prevencion.consulta", compact("vehiculos", "users"));
	}

    public function busquedaentrefechas(Request $request)
	{
		
		$fechaD = $request->fechaD;
		$fechaH = $request->fechaH;
		$busquedaentrefechas = DB::table('movilizacions')
			->join('actividads', 'actividads.movilizacion_id', '=', 'movilizacions.id')
			/* ->select('nombre_incidente', DB::raw('count(station_id) salidas')) */
			->whereYear('fecha', '=', date('Y'))
			->whereNull('movilizacions.deleted_at')
			->whereBetween('fecha_salida', array($fechaD, $fechaH))
			->groupBy('nombre_incidente')
			->havingRaw('count(station_id) >= ?', [1])
			->get();
		return view("/consulta/entrefechas", compact('tabla','busquedaentrefechas','fechaD','fechaH'));
	}
}
