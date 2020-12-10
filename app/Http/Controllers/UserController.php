<?php

namespace App\Http\Controllers;

use Illuminate\ Http\ Request;
use App\ User;
use Maatwebsite\ Excel\ Facades\ Excel;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\ Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\ Support\ Facades\Session;
use App\Imports\ UsersImport;
use PDF;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new UsersImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/" );
    }

    public function importar()
    {
      return view("/user.import");
    }
}
