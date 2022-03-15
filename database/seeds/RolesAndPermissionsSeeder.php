<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'editt']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'config']);
        Permission::create(['name' => 'import']);
        Permission::create(['name' => 'export']);
        Permission::create(['name' => 'upload']);
        Permission::create(['name' => 'create_pdf']);
        Permission::create(['name' => 'send_mail']);

        // create roles and assign created permissions

      
        $role1 = Role::create(['name' => 'conductor']);
        $role2 = Role::create(['name' => 'admin']);
        $role3 = Role::create(['name'=> 'fireman']);
        $role4 = Role::create(['name'=>'supervisor']);
        $role5 = Role::create(['name' => 'consultor']);
        $role6 = Role::create(['name' => 'operador']);
        $role7 = Role::create(['name' => 'inspector']);
        $role8 = Role::create(['name' => 'salud']);
        $role9 = Role::create(['name' => 'employee']);
        $role10 = Role::create(['name' => 'Super-Admin']);
        $role10->givePermissionTo(Permission::all());
        // create demo users
        $user  = User::findOrFail(2);
        $user->assignRole($role10);
    }
}
