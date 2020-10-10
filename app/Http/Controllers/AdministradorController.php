<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdministradorController extends Controller
{
    //
	public function __construct(){
		$this->middleware('EsAdmin');
	}
	
	public function index(){
		return view('home');
	}
}
