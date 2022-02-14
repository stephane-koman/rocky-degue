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
            /* [
                'name' => 'show_user',
                'description' => 'Show user'
            ],
            [
                'name' => 'add_user',
                'description' => 'Add user'
            ],
            [
                'name' => 'edit_user',
                'description' => 'Edit user'
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
                'name' => 'edit_role',
                'description' => 'Edit role'
            ],
            [
                'name' => 'delete_role',
                'description' => 'Delete role'
            ],
            [
                'name' => 'show_permission',
                'description' => 'Show permission'
            ], */
            [
                'name' => 'show_country',
                'description' => 'Show country'
            ],
            [
                'name' => 'add_country',
                'description' => 'Add country'
            ],
            [
                'name' => 'edit_country',
                'description' => 'Edit country'
            ],
            [
                'name' => 'delete_country',
                'description' => 'Delete country'
            ],
            [
                'name' => 'show_city',
                'description' => 'Show city'
            ],
            [
                'name' => 'add_city',
                'description' => 'Add city'
            ],
            [
                'name' => 'edit_city',
                'description' => 'Edit city'
            ],
            [
                'name' => 'delete_city',
                'description' => 'Delete city'
            ],
        ]);
    }
}
