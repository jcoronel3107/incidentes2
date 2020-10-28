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
        Permission::create(['name' => 'create evento']);;
        Permission::create(['name' => 'view estadisticas']);
        Permission::create(['name' => 'view parametrizacion']);
        Permission::create(['name' => 'allow import']);
        Permission::create(['name' => 'allow export']);
        Permission::create(['name' => 'create pdf']);
        Permission::create(['name' => 'send mail']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role1 = Role::create(['name' => 'creador']);
        $role1->givePermissionTo('edit evento');
        $role1->givePermissionTo('create evento');
        $role1->givePermissionTo('allow import');

        // this can be done as separate statements
        $role2 = Role::create(['name' => 'consultor']);
        $role2->givePermissionTo('view estadisticas');

        // this can be done as separate statements
        $role3 = Role::create(['name' => 'supervisor']);
        $role3->givePermissionTo('delete evento');
        $role3->givePermissionTo('create evento');
        $role3->givePermissionTo('edit evento');
        $role3->givePermissionTo('view parametrizacion');
        $role3->givePermissionTo('view estadisticas');
        $role3->givePermissionTo('allow export');
        $role3->givePermissionTo('create pdf');
        $role3->givePermissionTo('send mail');

        /*// or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['publish articles', 'unpublish articles']);
*/
        $role4 = Role::create(['name' => 'super-admin']);
        $role4->givePermissionTo(Permission::all());

        // create demo users
        $user = Factory(App\User::class)->create([
            'name' => 'Juan Fernando Coronel',
            'email' => 'jcoronel@bomberos.gob.ec',
            'cargo' => 'Analista 2 Sistemas',
            'password' => Hash::make('K@rin@2018')
        ]);
        $user->assignRole($role4);

        // create demo users
        $user = Factory(App\User::class)->create([
            'name' => 'Maria Agusta Perez',
            'email' => 'mperez@bomberos.gob.ec',
            'cargo'=> 'Asistente Administrativa',
            'password' => Hash::make('secret')
        ]);
        $user->assignRole($role2);

        $user = Factory(App\User::class)->create([
            'name' => 'Mayra Cedillo',
            'email' => 'mcedillo@bomberos.gob.ec',
            'cargo'=> 'Asistente Administrativa',
            'password' => Hash::make('secret')
        ]);
        $user->assignRole($role2);

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

        $user = Factory(App\User::class)->create([
            'name'=> 'Dario Vimos',
            'email'=> 'dvimos@bomberos.gob.ec',
            'cargo'=> 'bombero',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name'=> 'Juan Llivisupa',
            'email'=> 'jllivisupa@bomberos.gob.ec',
            'cargo'=> 'bombero',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name'=> 'Juan Apolo',
            'email'=> 'japolo@bomberos.gob.ec',
            'cargo'=> 'bombero',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name'=> 'Juan Alvarez',
            'email'=> 'jalvarez@bomberos.gob.ec',
            'cargo'=> 'maquinista',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name'=> 'Eduardo Ortega',
            'email'=> 'eortega@bomberos.gob.ec',
            'cargo'=> 'maquinista',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name'=> 'Jorge Webster',
            'email'=> 'jwebster@bomberos.gob.ec',
            'cargo'=> 'maquinista',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name'=> 'Jonathan Quintanilla',
            'email'=> 'jquintanilla@bomberos.gob.ec',
            'cargo'=> 'bombero',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name'=> 'Maria Fernanda Vicuña',
            'email'=> 'mvicuna@bomberos.gob.ec',
            'cargo'=> 'bombero',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name'=> 'Rodolfo Elizalde',
            'email'=> 'relizalde@bomberos.gob.ec',
            'cargo'=> 'bombero',
            'password'=> Hash::make('secret')
        ]);
        $user->assignRole($role1);
    }
}
