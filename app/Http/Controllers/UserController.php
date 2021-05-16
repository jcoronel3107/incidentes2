<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Imports\UsersImport;
use Illuminate\Cookie\CookieValuePrefix;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
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
            $users = User::where("name", 'LIKE', '%' . $query . '%')
                ->OrderBy('name', 'desc')
                ->paginate(15);
            return view("/user.index", compact("users", "query"));
        }
    }

    protected function store(array $data)
    {


         return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cargo'=>$data['cargo'],
            'status'=>$data['status'],
        ]);
     
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new UsersImport, $file);
        Session::flash('Importación_Correcta',"Importación Realizada con Exito!!!");
        return redirect( "/" );
    }

    public function importar()
    {
      return view("/user.import");
    }

    public function rol()
    {
        $user = Auth::user();
        $all_roles_in_database = Role::all();
        $all_permissions_in_database = Permission::all();
        $users = User::all();
        // Permissions inherited from the user's roles
        $PermissionsViaRoles=$user->getPermissionsViaRoles();
        return view("/user.rol",compact('users','all_roles_in_database', 'all_permissions_in_database', 'PermissionsViaRoles'));
    }

    public function ConsultaRolUsuario($id)
    {
        $user = User::find($id);
        $roles = $user->getRoleNames()->tojson();
        return ($roles);
    }
   

    protected function getTokenfromRequest(Request $request)
    {
        $token=$request->input('_token')?:$request->header('X-CSRF-TOKEN');
        if (! $token && $header = $request->header('X-CSRF-TOKEN') ) {
            $token = CookieValuePrefix::remove($this->encrypter->decrypt($header,static::serialized()));
        }
        return $token;
    }

    public function PerrmisosxRol ($id)
    {
        
        $rol = Role::findByName($id);
        $PermissionsViaRoles = $rol->permissions;
        return $PermissionsViaRoles;
    }

    public function CambiaPermisosRol(Request $request)
    {
        
        $permisos = $request->permissions;
        $rol = Role::findByName($request->Roles);
        //dd($permisos);
        $rol->syncPermissions([$permisos]);
        Session::flash('Permisos Asignado', "Asignación Permisos con Exito!!!");
        return redirect("/user");
    }

    public function CambiaRoldeUsuario(Request $request)
    {
        //$user = Auth::user();
        $user = User::find($request->user);
        $user->syncRoles([$request->Roles]);
        Session::flash('Rol Asignado', "Asignación Rol con Exito!!!");
        return redirect("/user");
    }

    public function update2(Request $request) {
        //
        $user = $request->user_id;
  
          $validaciones = [
              'name' => ['required', 'string', 'max:255', 'unique:users,name,'.$user],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user],
          ];
  
          $request->validate($validaciones, $this->errores);
  
          $user->name = $request->name;
          $user->email = $request->email;
          
          
          if(! $user->isDirty())
              { return redirect()->route('profile.index')->with("status", 'No se detectaron cambios a realizar');
               }
           $user->save();
  
          return redirect()->route('profile.index')->with("status", 'Datos actualizados');
        
    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     public function edit($id)
    {
        if ( Auth::check() ) {
            $user = User::findorFail($id);
            return view( "user.edit",compact("user"));
        } else {
            return view( "/auth.login" );
        }
    }

}
