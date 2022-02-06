<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'show_user',
                'description' => 'Show user'
            ],
            [
                'name' => 'add_user',
                'description' => 'Add user'
            ],
            [
                'name' => 'update_user',
                'description' => 'Update user'
            ],
            [
                'name' => 'delete_user',
                'description' => 'Delete user'
            ],
            [
                'name' => 'show_role',
                'description' => 'Show role'
            ],
            [
                'name' => 'add_role',
                'description' => 'Add role'
            ],
            [
                'name' => 'update_role',
                'description' => 'Update role'
            ],
            [
                'name' => 'delete_role',
                'description' => 'Delete role'
            ],
            [
                'name' => 'show_permission',
                'description' => 'Show permission'
            ]
        ]);
    }
}
