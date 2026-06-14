<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectname = strtolower(str_replace(" ", "", config('app.name')));
        $superAdmin = Admin::firstOrCreate([
            'id' => 1,
        ], [
            'name' => "Admin",
            'email' => 'admin@' . $projectname . '.com',
            'password' => bcrypt('123456789'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $superAdminRole = Role::where('name', 'SuperAdmin')->where('guard_name', 'admin')->first();

        if ($superAdminRole) {
            $superAdmin->assignRole($superAdminRole);
        }
    }
}
