<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $errores;

    public function __construct(){
    $this->errores = [
      'required' => 'El campo es requerido.',
      'email' => 'Email incorrecto',
      'password.min' => 'La contraseña debe tener por lo menos :min caracteres',
      'nuevo.confirmed' => 'Las contraseñas no coinciden',
      'nuevo.min' => 'La contraseña debe tener por lo menos :min caracteres',
    ];
  }

    public function index()
    {
        $all_roles_in_database = Role::all();
        return view('/perfil.profile',compact('all_roles_in_database'));
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
    public function update(Request $request)
    {
        $user = \Auth::user();

        $validaciones = [
            'name' => ['required', 'string', 'max:255', 'unique:users,name,'.$user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ];

        $request->validate($validaciones, $this->errores);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        
        if(! $user->isDirty())
            { return redirect()->route('profile.index')->with("status", 'No se detectaron cambios a realizar');
             }
         $user->save();

        return redirect()->route('profile.index')->with("status", 'Datos actualizados');
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

    public function update_avatar(Request $request){
        
        $user = \Auth::user();
        $fileavatar = $request->file('avatar');
        
        $nombre = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
        
        $validation = $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048'
        
        ]);
        $user->avatar = $nombre;
        $user->save();
        $file      = $validation['avatar']; // get the validated file        
        $path      = $file->storeAs('avatar/', $nombre);


        

        return redirect()->route('profile.index', ['#foto'])->with("status", 'Foto actualizada');
    }// /update_avatar

    public function pass(Request $request){
        $validaciones = [
          'pass1' => [
            'required',
            'string',
            function ($attribute, $value, $fail) {
              if( ! Hash::check( $value, \Auth::user()->password) ){ $fail('Contraseña actual incorrecta'); }
            },
          ],
          'nuevo' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $validator = Validator::make($request->all(), $validaciones, $this->errores);
         if ($validator->fails()) {
           return redirect(route('profile.update', ['#pass']))->withErrors($validator)->withInput();
         }

        $user = \Auth::user();
        $user->password = bcrypt($request->input('nuevo'));

        activity()->disableLogging();
        $user->save();
        activity()->enableLogging();
        activity()->log('Contraseña actualizada');

        return redirect()->route('profile.index')->with("status", 'Contraseña actualizada');
    } // /pass

    public function ConsultaPermisosxUsuario($id)
    {
      $user = \Auth::user();
      $permissionNames = $user->getPermissionNames();
      return $permissionNames;
    }
}
