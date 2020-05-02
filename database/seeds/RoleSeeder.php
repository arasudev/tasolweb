<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'super admin', 'guard_name' => 'web'],
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'user', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate([
                'name' => $role['name'],
                'guard_name' => $role['guard_name'],
            ], [
                'name' => $role['name'],
                'guard_name' => $role['guard_name'],
            ]);
        }

        $permissions = Permission::all();

        $role = Role::where('name', 'super admin')->first();
        $role->syncPermissions($permissions);

        $user = User::where('email', 'poovarasu@mallow-tech.com')->first();
        $user->assignRole('super admin');

        $user = User::where('email', 'anandhan@mallow-tech.com')->first();
        $user->assignRole('super admin');
    }
}
