<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Permission::create(['name' => 'user_edit']);
        Permission::create(['name' => 'user_delete']);
        Permission::create(['name' => 'user_create']);
        Permission::create(['name' => 'user_view']);

        Permission::create(['name' => 'role_edit']);
        Permission::create(['name' => 'role_delete']);
        Permission::create(['name' => 'role_create']);
        Permission::create(['name' => 'role_view']);

        Permission::create(['name' => 'post_edit']);
        Permission::create(['name' => 'post_delete']);
        Permission::create(['name' => 'post_create']);
        Permission::create(['name' => 'post_view']);

        Permission::create(['name' => 'category_edit']);
        Permission::create(['name' => 'category_delete']);
        Permission::create(['name' => 'category_create']);
        Permission::create(['name' => 'category_view']);


    }
}
