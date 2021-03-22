<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        Permission::create(['name' => 'edit evento']);
        Permission::create(['name' => 'delete evento']);
        Permission::create(['name' => 'create evento']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'view estadisticas']);
        Permission::create(['name' => 'view parametrizacion']);
        Permission::create(['name' => 'allow import']);
        Permission::create(['name' => 'allow export']);
        Permission::create(['name' => 'allow upload']);
        Permission::create(['name' => 'create pdf']);
        Permission::create(['name' => 'send mail']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role1 = Role::create(['name' => 'creador']);
        $role1->givePermissionTo('edit evento');
        $role1->givePermissionTo('create evento');
        $role1->givePermissionTo('allow import');
        $role1->givePermissionTo('allow upload');

        // this can be done as separate statements
        $role2 = Role::create(['name' => 'consultor']);
        $role2->givePermissionTo('view estadisticas');

        // this can be done as separate statements
        $role3 = Role::create(['name' => 'supervisor']);
        $role3->givePermissionTo('delete evento');
        $role3->givePermissionTo('create evento');
        $role3->givePermissionTo('create user');
        $role3->givePermissionTo('edit evento');
        $role3->givePermissionTo('view parametrizacion');
        $role3->givePermissionTo('view estadisticas');
        $role3->givePermissionTo('allow export');
        $role3->givePermissionTo('allow upload');
        $role3->givePermissionTo('create pdf');
        $role3->givePermissionTo('send mail');

        // this can be done as separate statements
        $role4 = Role::create(['name' => 'fireman']);
        $role4->givePermissionTo('create pdf');
        $role4->givePermissionTo('allow upload');

        // this can be done as separate statements
        $role5 = Role::create(['name' => 'admin']);
        $role5->givePermissionTo('delete evento');
        $role5->givePermissionTo('create evento');
        $role5->givePermissionTo('create user');
        $role5->givePermissionTo('edit evento');
        $role5->givePermissionTo('view parametrizacion');
        $role5->givePermissionTo('view estadisticas');
        $role5->givePermissionTo('allow export');
        $role5->givePermissionTo('allow upload');
        $role5->givePermissionTo('create pdf');
        $role5->givePermissionTo('send mail');

        $role6 = Role::create(['name' => 'conductor']);
        $role6->givePermissionTo('create pdf');
        $role6->givePermissionTo('allow upload');

        /*// or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['publish articles', 'unpublish articles']);
*/
        $role7 = Role::create(['name' => 'Super-Admin']);
        $role7->givePermissionTo(Permission::all());

        // create demo users
        $user = Factory(App\User::class)->create([
            'name' => 'Juan Fernando Coronel',
            'email' => 'jcoronel@bomberos.gob.ec',
            'cargo' => 'Analista 2 Sistemas',
            'password' => Hash::make('K@rin@2018')
        ]);
        $user->assignRole($role7);

        
        $user = Factory(App\User::class)->create([
            'name'=> 'Severo Regalado',
            'email'=> 'sregalado@bomberos.gob.ec',
            'cargo'=> 'operador',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role3);

        $user = Factory(App\User::class)->create([
            'name'=> 'Freddy Romero',
            'email'=> 'fromero@bomberos.gob.ec',
            'cargo'=> 'operador',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role3);

        $user = Factory(App\User::class)->create([
            'name'=> 'Renato Fernandez Cordova',
            'email'=> 'rfernandezcordova@bomberos.gob.ec',
            'cargo'=> 'operador',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role3);

        $user = Factory(App\User::class)->create([
            'name'=> 'Patricio Bravo',
            'email'=> 'pbravo@bomberos.gob.ec',
            'cargo'=> 'operador',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role3);
    }
}
