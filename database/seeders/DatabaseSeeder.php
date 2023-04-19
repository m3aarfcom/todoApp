<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $manager = Role::create(['name' => 'manager',]);
        $employee = Role::create(['name' => 'employee',]);

        $create = Permission::create(['name' => 'create_task']);
        $read   = Permission::create(['name' => 'read_task']);
        $update = Permission::create(['name' => 'update_task']);
        $delete = Permission::create(['name' => 'delete_task']);
        $toggle = Permission::create(['name' => 'toggle_task']);
        $read_notifications = Permission::create(['name' => 'read_notifications']);



        $manager->givePermissionTo($create);
        $manager->givePermissionTo($read);
        $manager->givePermissionTo($update);
        $manager->givePermissionTo($delete);
        $manager->givePermissionTo($toggle);

        $employee->givePermissionTo($read);
        $employee->givePermissionTo($toggle);
        $employee->givePermissionTo($read_notifications);


        $admin =  \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@todo.com',
            'password' => Hash::make(123123123),
            'email_verified_at' => now(),
        ]);
        $user_1 =  \App\Models\User::create([
            'name' => 'user_1',
            'email' => 'user_1@todo.com',
            'password' => Hash::make(123123123),
            'email_verified_at' => now(),
        ]);
        $user_2 =  \App\Models\User::create([
            'name' => 'user_2',
            'email' => 'user_2@todo.com',
            'password' => Hash::make(123123123),
            'email_verified_at' => now(),
        ]);
        $user_3 =  \App\Models\User::create([
            'name' => 'user_3',
            'email' => 'user_3@todo.com',
            'password' => Hash::make(123123123),
            'email_verified_at' => now(),
        ]);

        $admin->assignRole($manager);
        $user_1->assignRole($employee);
        $user_2->assignRole($employee);
        $user_3->assignRole($employee);
    }
}
