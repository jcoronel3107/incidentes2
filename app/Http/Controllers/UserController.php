<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Imports\UsersImport;
use Illuminate\Cookie\CookieValuePrefix;
use PDF;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;






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

    public function index(Request $request)
    {
        //
        if ($request) {
            $query = trim($request->get('searchText'));
            $users = User::where("name", 'LIKE', '%' . $query . '%')
                ->OrderBy('name', 'desc')
                ->paginate(15);
            return view("/user.index", compact("users", "query"));
        }
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
        /* $user = Auth::user(); */
        $rol = Role::findByName($request->Roles);
        $rol->syncPermissions([$request->permissions]);
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
}
