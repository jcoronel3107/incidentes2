<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ CieImport;
use Maatwebsite\ Excel\ Facades\ Excel;
use Illuminate\ Support\ Facades\Session;
use Illuminate\ Support\ Facades\ Auth;


class CieController extends Controller
{
    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new CieImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/salud" );
    }

    public function importar()
    {
      return view("/cie.import");
    }
}
