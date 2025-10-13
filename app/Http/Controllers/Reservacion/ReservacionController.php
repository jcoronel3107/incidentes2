<?php

namespace App\Http\Controllers\Reservacion;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReservacionController extends Controller
{
    public function index()
    {
        $CantVehiculosDisponibles = DB::table('vehiculos')
        ->select('id')
        ->where('observacion', 'Servicio')
        ->where('activo','1')
        ->whereNotIn('id',DB::table('assignments')->select('vehiculo_id')->where('estado','En Curso'))
        ->get()->count();
       

        $CantVehiculosEnUso = DB::table('vehiculos')
        ->rightJoin('assignments','vehiculos.id', '=', 'assignments.vehiculo_id')
        ->where('assignments.estado','En Curso')
        ->get()->count();
        

        $CantVehiculosServicio = DB::table('vehiculos')
				->select('id')
				->where('observacion', 'Servicio')
                ->where('activo','1')
				->whereNull('vehiculos.deleted_at')
				->get()->count();

        $ListVehiculosDisponibles = DB::table('vehiculos')
                ->select('id','codigodis','placa','marca','modelo')
                ->where('observacion', 'Servicio')
                ->where('activo','1')
                ->whereNotIn('id',DB::table('assignments')->select('vehiculo_id')->where('estado','En Curso'))
                ->orderByDesc('codigodis')
                ->get();
               
        
        $ListVehiculosEnUso = DB::table('vehiculos')
                ->rightJoin('assignments','vehiculos.id', '=', 'assignments.vehiculo_id')
                ->select('vehiculos.id','codigodis','placa','marca','modelo')
                ->where('assignments.estado','En Curso')
                ->orderByDesc('codigodis')
                ->get();
                
        
        $ListVehiculosServicio = DB::table('vehiculos')
                        ->select('id','codigodis','placa','marca','modelo')
                        ->where('observacion', 'Servicio')
                        ->where('activo','1')
                        ->whereNull('vehiculos.deleted_at')
                        ->orderByDesc('codigodis')
                        ->get();
        
        return view('reservas.welcome',compact("CantVehiculosDisponibles","CantVehiculosEnUso","CantVehiculosServicio","ListVehiculosDisponibles","ListVehiculosEnUso","ListVehiculosServicio"));
    }

    public function chequearcalendario()
    {
        return view('calendar');
    }

    public function formasistencia()
    {
        return view('asistencia');
    }
}
