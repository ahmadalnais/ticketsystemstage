<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Permissions

        
        $permission = Permission::Create(['name'   => 'view-users',        'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'update-users',      'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'create-users',      'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'delete-users',      'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'view-ticket',       'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'update-ticket',     'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'create-ticket',     'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'delete-ticket',     'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'view-project',      'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'update-project',    'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'create-project',    'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'delete-project',    'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'view-browser',      'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'update-browser',    'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'create-browser',    'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'delete-browser',    'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'view-role',         'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'update-role',       'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'create-role',       'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'delete-role',       'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'view-permission',   'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'update-permission', 'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'create-permission', 'guard_name' => 'web']);
        $permission = Permission::Create(['name'   => 'delete-permission', 'guard_name' => 'web']);

        // Admin Role
        $admin = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $admin->givePermissionTo(Permission::all());
        
        $user = App\User::whereEmail('techmen27@gmail.com')->first();
        $user->givePermissionTo(Permission::all());
        $user->assignRole('Admin');


        // Customer Role
        $customer = Role::create(['name' => 'Customer', 'guard_name' => 'web']);
        $customer->givePermissionTo(['view-ticket', 'view-project', 'create-ticket', 'create-project',
            'update-ticket', 'update-project',
        ]);

        $user_customer = App\User::whereEmail('max@gmail.com')->first();
        $user_customer->givePermissionTo(['view-ticket', 'view-project', 'create-ticket', 'create-project',
            'update-ticket', 'update-project',
        ]);
        
        $user_customer->assignRole('Customer');
    }
}
