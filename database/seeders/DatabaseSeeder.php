<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Step 1: Create default roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);

        // Step 2: Define permissions by resource & action
        $resources = ['shipments', 'couriers', 'users', 'roles', 'permissions'];
        $actions = ['view', 'create', 'edit', 'delete'];

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                $permission = Permission::firstOrCreate([
                    'name' => "$action $resource",
                    'guard_name' => 'web',
                ]);

                // Step 3: Assign all permissions to admin
                $adminRole->givePermissionTo($permission);
            }
        }

        // Step 4: Create user and assign admin role
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        $user->assignRole($adminRole);
    }
}
