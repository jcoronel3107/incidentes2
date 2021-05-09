<?php

namespace App\Http\Controllers;

use App\Actividad;
use Illuminate\Http\Request;
use App\Vehiculo;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Movilizacion;
use Dotenv\Loader\Value;
use Hamcrest\Type\IsString;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;


class MovilizacionController extends Controller
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
            $movilizacions = Movilizacion::where("created_at",'LIKE','%'.$query.'%')
              ->OrderBy('created_at','desc')
              ->paginate(10);
            return view( "prevencion.index", compact( "movilizacions","query"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehiculos = Vehiculo::orderBy('codigodis')->where('activo','1')->get();
        $users = User::where('cargo','Inspector')
            ->orderBy("name",'asc')
            ->get();
            return view( "/prevencion.crear",compact("vehiculos","users") );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        /* $datosSolicitud = request()->except(['_token','_method']);
        Movilizacion::create($datosSolicitud); */
        $id = DB::table('movilizacions')
                ->select(DB::raw('max(id) as id'))
                ->value('id');
        $detalle_filtrado = Arr::where($request->detalle,function($value,$key){
            return is_string($value);
        });
        
        dd($request);
        for($i=0; $i < count($request->actividad) ;$i++){
           
            $actividad = new Actividad;
            $actividad->descripcion = $request->actividad[$i];
            
            /* $actividad->detalle = $detalle_filtrado[$i]; */
            $actividad->movilizacion_id = $id;
            $actividad->save();
            
        }
        Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
        return redirect( "/prevencion" );
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
