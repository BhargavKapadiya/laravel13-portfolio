<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            ['name' => 'user-list', 'guard_name' => 'admin'],
            ['name' => 'user-create', 'guard_name' => 'admin'],
            ['name' => 'user-edit', 'guard_name' => 'admin'],
            ['name' => 'user-delete', 'guard_name' => 'admin'],

            ['name' => 'blog-list', 'guard_name' => 'admin'],
            ['name' => 'blog-create', 'guard_name' => 'admin'],
            ['name' => 'blog-edit', 'guard_name' => 'admin'],
            ['name' => 'blog-delete', 'guard_name' => 'admin'],

            ['name' => 'faq-list', 'guard_name' => 'admin'],
            ['name' => 'faq-create', 'guard_name' => 'admin'],
            ['name' => 'faq-edit', 'guard_name' => 'admin'],
            ['name' => 'faq-delete', 'guard_name' => 'admin'],

            ['name' => 'category-list', 'guard_name' => 'admin'],
            ['name' => 'category-create', 'guard_name' => 'admin'],
            ['name' => 'category-edit', 'guard_name' => 'admin'],
            ['name' => 'category-delete', 'guard_name' => 'admin'],

            ['name' => 'enquiry-list', 'guard_name' => 'admin'],
            ['name' => 'enquiry-create', 'guard_name' => 'admin'],
            ['name' => 'enquiry-edit', 'guard_name' => 'admin'],
            ['name' => 'enquiry-delete', 'guard_name' => 'admin'],

            ['name' => 'email-list', 'guard_name' => 'admin'],
            ['name' => 'email-create', 'guard_name' => 'admin'],
            ['name' => 'email-edit', 'guard_name' => 'admin'],
            ['name' => 'email-delete', 'guard_name' => 'admin'],

            ['name' => 'role-list', 'guard_name' => 'admin'],
            ['name' => 'role-create', 'guard_name' => 'admin'],
            ['name' => 'role-edit', 'guard_name' => 'admin'],
            ['name' => 'role-delete', 'guard_name' => 'admin'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission['name'],
                'guard_name' => $permission['guard_name'],
            ]);
        }
    }
}
