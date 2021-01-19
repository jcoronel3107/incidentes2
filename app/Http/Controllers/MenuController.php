<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\ Support\Carbon;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
       return view("welcome");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view("consultas");
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
	
	public function estadisticas()
    {
        return view("estadisticas");
    }
	
	public function reportar()
    {
        return view("reportar");
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

    public function evento()
    {
        $now = Carbon::now();
        $SaludEst1 = DB::table('saluds')
                ->select( DB::raw('count(station_id) salidas'))
                ->where('station_id','=','1')
                ->whereYear('fecha', '=', date('Y'))
                ->whereNull('saluds.deleted_at')
                ->groupBy('station_id')
                ->havingRaw('count(station_id) >= ?',[1])
                ->get();

        $FuegoEst1 = DB::table('incendios')
                ->select( DB::raw('count(station_id) salidas'))
                ->where('station_id','=','1')
                ->whereYear('fecha', '=', date('Y'))
                ->whereNull('incendios.deleted_at')
                ->groupBy('station_id')
                ->havingRaw('count(station_id) >= ?',[1])
                ->get();

        $HazmatEst1 = DB::table('incendios')
                ->select( DB::raw('count(station_id) salidas'))
                ->where('station_id','=','1')
                ->whereYear('fecha', '=', date('Y'))
                ->whereNull('incendios.deleted_at')
                ->groupBy('station_id')
                ->havingRaw('count(station_id) >= ?',[1])
                ->get();
           
        $mensualesInundacion="";
        $station = trans('messages.Station1');
        return view("evento", compact( "mensualesInundacion","station","now") );
    }

    public function evento2()
    {
        $now = Carbon::now();
        $mensualesInundacion="";
        $station = trans('messages.Station2');
        return view("evento", compact( "mensualesInundacion","station","now") );
    }

    public function evento3()
    {
        $now = Carbon::now();
        $mensualesInundacion="";
        $station = trans('messages.Station3');
        return view("evento", compact( "mensualesInundacion","station","now") );
    }
    public function evento4()
    {
        $now = Carbon::now();
        $mensualesInundacion="";
        $station = trans('messages.Station4');
        return view("evento", compact( "mensualesInundacion","station","now") );
    }
    public function evento5()
    {
        $now = Carbon::now();
        $mensualesInundacion="";
        $station = trans('messages.Station5');
        return view("evento", compact( "mensualesInundacion","station","now") );
    }
    public function evento6()
    {
        $now = Carbon::now();
        $mensualesInundacion="";
        $station = trans('messages.Station6');
        return view("evento", compact( "mensualesInundacion","station","now") );
    }
    public function evento7()
    {
        $now = Carbon::now();
        $mensualesInundacion="";
        $station = trans('messages.Station7');
        return view("evento", compact( "mensualesInundacion","station","now") );
    }
    public function evento8()
    {
        $now = Carbon::now();
        $mensualesInundacion="";
        $station = trans('messages.Station8');
        return view("evento", compact( "mensualesInundacion","station","now") );
    }
    public function evento9()
    {
        $now = Carbon::now();
        $mensualesInundacion="";
        $station = trans('messages.Station9');
        return view("evento", compact( "mensualesInundacion","station","now") );
    }
}
