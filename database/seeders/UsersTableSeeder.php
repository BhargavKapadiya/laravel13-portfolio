<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projectname = strtolower(str_replace(" ", "", config('app.name')));
        $user = User::firstOrCreate([
            'id' => 1,
        ], [
            'name' => "Admin",
            'email' => 'admin@' . $projectname . '.com',
            'password' => bcrypt('123456789'),
            'is_active' => 1,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $userRole = Role::where('name', 'SuperAdmin')->where('guard_name', 'web')->first();

        if ($userRole) {
            $user->assignRole($userRole);
        }
    }
}
