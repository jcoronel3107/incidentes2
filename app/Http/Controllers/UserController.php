<?php

namespace App\Http\Controllers;

use App\Exports\DisponibilidadUserExport;
use Illuminate\Http\Request;
use App\User;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Imports\UsersImport;
use App\Personnel_Employee;
use Illuminate\Cookie\CookieValuePrefix;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;


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
       
        $rol->syncPermissions([$permisos]);
        Session::flash('Permisos Asignado', "Asignación Permisos con Exito!!!");
        return redirect("/user");
    }

    public function CambiaRoldeUsuario(Request $request)
    {
        //$user = Auth::user();
        $user = User::find($request->user);
        /*  dd($user); */
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
    
     public function edit($id){
        if ( Auth::check() ) {
            $user = User::findorFail($id);
            return view( "user.edit",compact("user"));
        } else {
            return view( "/auth.login" );
        }
    }

    protected function createpermiso(Request $request){


        $datospermiso = request()->except(['_token','_method']);
        
        Permission::create($datospermiso);
        return redirect()->route('profile.index')->with("status", 'Datos actualizados');
        
     
    }

    public function profile_employed(string $mail){
        $Listpersonnel_employee = DB::connection('pgsql')->table('personnel_employee')
        ->join('personnel_department','personnel_employee.department_id','=', 'personnel_department.id')
        ->join('personnel_position','personnel_employee.position_id','=','personnel_position.id')
        ->join('personnel_certification','personnel_employee.emp_type','=','personnel_certification.id')
        ->where('personnel_employee.email','=',$mail)
        ->orderByDesc('personnel_employee.emp_code')
        ->first();
        
        return view( "user.profile",compact('Listpersonnel_employee'));

    }

    public function downloadPDF(Request $request) {
        
        $date = Carbon::now();
        $date = $date->format('l jS \\of F Y h:i:s A');
        $contract="";
        $department="";
        $position="";
        if($request->tipocertificado=='1'){
            
            $Cert_employee = Personnel_Employee::where('personnel_employee.email',Auth::user()->email)->first();
            
            for($i=0;$i<$Cert_employee->Personnel_Department->count();++$i){
                $department = $Cert_employee->Personnel_Department->dept_name;
            }
            
            $position= $Cert_employee->Personnel_Position->position_name;

          
            
            foreach($Cert_employee->Personnel_EmployeeCertification as $item){
                $contract = $item->cert_name;
            }
           
            
            $dompdf = App::make("dompdf.wrapper");
            $dompdf->loadView('user.jobCertificate', compact('Cert_employee','date','contract','department','position'));
            return $dompdf->stream();
        }
        if($request->tipocertificado=='2'){
           
            $Cert_employee = Personnel_Employee::where('personnel_employee.email',Auth::user()->email)->first();
            
            for($i=0;$i<$Cert_employee->Personnel_Department->count();++$i){
                $department = $Cert_employee->Personnel_Department->dept_name;
            }
            
            $position= $Cert_employee->Personnel_Position->position_name;

            foreach($Cert_employee->Personnel_EmployeeCertification as $item){
                $contract = $item->cert_name;
            }
            
            $rol_employee = DB::connection('mysql2')->table('personal')
            ->where('personal.perscedula','=',$Cert_employee->passport)
            ->first();
            
            $dompdf = App::make("dompdf.wrapper");
            $dompdf->loadView('user.salaryCertificate', compact('Cert_employee','date','rol_employee','contract','department','position'));
            return $dompdf->stream();
        }
        
    }

    public function downloadPDFAnticipo(Request $request) {
     
        $date = Carbon::now();
       
            $date = $date->format('l jS \\of F Y h:i:s A');
            $monto = $request->monto;
            $plazo = $request->plazo;
            $Cert_employee = DB::connection('pgsql')->table('personnel_employee')
            ->select('first_name','last_name','passport','hire_date','position_name','dept_name','cert_name')
            ->join('personnel_department','personnel_employee.department_id','=', 'personnel_department.id')
            ->join('personnel_position','personnel_employee.position_id','=','personnel_position.id')
            ->join('personnel_certification','personnel_employee.emp_type','=','personnel_certification.id')
            ->where('personnel_employee.email','=',Auth::user()->email)
            ->orderByDesc('personnel_employee.emp_code')
            ->first();
            $dompdf = App::make("dompdf.wrapper");
            $dompdf->loadView('user.anticipoRemuneracion', compact('Cert_employee','date','plazo','monto'));
            return $dompdf->stream();
               
    }

    public function rolPagoMensual(Request $request) {
     
        $date = Carbon::now();
        $fecha = Carbon::parse($request->mesrol);
        $mfecha = $fecha->month;
        $dfecha = $fecha->day;
        $afecha = $fecha->year;
        
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        $mesletra=$meses[$mfecha - 1];
        
       
        
        
        $date = $date->format('l jS \\of F Y ');
        $rol_employee = DB::connection('mysql2')->table('acumrol')
            ->join('personal','personal.perscodigo','=', 'acumrol.codigo')
            ->where('personal.perscedula','=',$request->cedula)
            ->whereYear('acumrol.fecha',$afecha)
            ->whereMonth('acumrol.fecha',  $mfecha)
            ->first();
          
        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView('user.rolMensual', compact('rol_employee','mesletra','date','mfecha','afecha'));
        return $dompdf->stream();
        
        
    }

  
    public function status(){
            $date = Carbon::now();
            $date = $date->format('l jS \\of F Y h:i:s A');
            
            $Nombramiento_employee = DB::connection('pgsql')->table('personnel_employee')
            ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
            ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
            ->where('personnel_certification.id','=','1')
            ->where('status','=',0)
            ->get();
            $Codigo_employee = DB::connection('pgsql')->table('personnel_employee')
            ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
            ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
            ->where('personnel_certification.id','=','2')
            ->where('status','=',0)
            ->get();
            $Ocacional_employee = DB::connection('pgsql')->table('personnel_employee')
            ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
            ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
            ->where('personnel_certification.id','=','3')
            ->where('status','=',0)
            ->get();
            $NomProvisional_employee = DB::connection('pgsql')->table('personnel_employee')
            ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
            ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
            ->where('personnel_certification.id','=','4')
            ->where('status','=',0)
            ->get();
            $LibreRemocion_employee = DB::connection('pgsql')->table('personnel_employee')
            ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
            ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
            ->where('personnel_certification.id','=','5')
            ->where('status','=',0)
            ->get();
            $TotalNomina_employee = DB::connection('pgsql')->table('personnel_employee')
            ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
            ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
            ->where('status','=',0)
            ->get();
            $Desvinculado_employee = DB::connection('pgsql')->table('personnel_employee')
            ->join('personnel_resign','personnel_employee.id','=','personnel_resign.employee_id')
            ->select('personnel_resign.resign_date','personnel_resign.resign_type','personnel_resign.reason','personnel_resign.employee_id','personnel_employee.id','personnel_employee.emp_code','personnel_employee.first_name','personnel_employee.last_name','personnel_employee.passport','personnel_employee.hire_date')
            ->get();

            $count_gender = DB::connection('pgsql')->table('personnel_employee')
            ->select('personnel_employee.gender',DB::raw('count(gender) cant'))
            ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
            ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
            ->groupBy('gender')
            ->where('status','=',0)
            ->get();
         
            return view('user.disponibilidad',compact('count_gender','Desvinculado_employee','TotalNomina_employee','LibreRemocion_employee','Nombramiento_employee','Codigo_employee','NomProvisional_employee','Ocacional_employee','date'));
    }

   

    public function export_pdf(){
        $date = Carbon::now();
        $date = $date->format('l jS \\of F Y h:i:s A');
        
        $Nombramiento_employee = DB::connection('pgsql')->table('personnel_employee')
        ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
        ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
        ->where('personnel_certification.id','=','1')
        ->where('status','=',0)
        ->orderByDesc('personnel_employee.last_name')
        ->get();
        $Codigo_employee = DB::connection('pgsql')->table('personnel_employee')
        ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
        ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
        ->where('personnel_certification.id','=','2')
        ->where('status','=',0)
        ->orderByDesc('personnel_employee.last_name')
        ->get();
        $Ocacional_employee = DB::connection('pgsql')->table('personnel_employee')
        ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
        ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
        ->where('personnel_certification.id','=','3')
        ->where('status','=',0)
        ->orderByDesc('personnel_employee.last_name')
        ->get();
        $NomProvisional_employee = DB::connection('pgsql')->table('personnel_employee')
        ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
        ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
        ->where('personnel_certification.id','=','4')
        ->where('status','=',0)
        ->orderByDesc('personnel_employee.last_name')
        ->get();

        $LibreRemocion_employee = DB::connection('pgsql')->table('personnel_employee')
        ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
        ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
        ->where('personnel_certification.id','=','5')
        ->where('status','=',0)
        ->orderByDesc('personnel_employee.last_name')
        ->get();
    
        $TotalNomina_employee = DB::connection('pgsql')->table('personnel_employee')
            ->join('personnel_employeecertification','personnel_employee.id','=','personnel_employeecertification.employee_id')
            ->join('personnel_certification','personnel_certification.id','=','personnel_employeecertification.certification_id')
            ->where('status','=',0)
            ->count();

        $Desvinculado_employee = DB::connection('pgsql')->table('personnel_employee')
        ->join('personnel_resign','personnel_employee.id','=','personnel_resign.employee_id')
        ->select('personnel_resign.resign_date','personnel_resign.resign_type','personnel_resign.reason','personnel_resign.employee_id','personnel_employee.id','personnel_employee.emp_code','personnel_employee.first_name','personnel_employee.last_name','personnel_employee.passport','personnel_employee.hire_date')
        ->orderByDesc('personnel_employee.last_name')
        ->get();
       
        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView('user.pdf', compact('date','TotalNomina_employee','Nombramiento_employee','Codigo_employee','Ocacional_employee','NomProvisional_employee','LibreRemocion_employee','Desvinculado_employee'));
        return $dompdf->stream();
    }

    public function export()
    {
        return Excel::download(new DisponibilidadUserExport, 'recursohumano.xlsx');
    }
}
