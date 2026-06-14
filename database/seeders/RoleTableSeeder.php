<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminSuperAdmin = Role::firstOrCreate([
            'name'        => 'SuperAdmin',
            'guard_name'  => 'admin',
        ]);

        $superAdmin = Role::firstOrCreate([
            'name'        => 'SuperAdmin',
            'guard_name'  => 'web',
        ]);

        $user = Role::firstOrCreate([
            'name'        => 'User',
            'guard_name'  => 'web',
        ]);

        $adminSuperAdmin->syncPermissions(Permission::all());
    }
}
