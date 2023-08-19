<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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

        Permission::create(['name' => User::USER_ACCESS]);
        Permission::create(['name' => User::USER_CREATE]);
        Permission::create(['name' => User::USER_EDIT]);
        Permission::create(['name' => User::USER_DELETE]);
        Permission::create(['name' => User::USER_VIEW]);

        Permission::create(['name' => User::ROLE_ACCESS]);
        Permission::create(['name' => User::ROLE_CREATE]);
        Permission::create(['name' => User::ROLE_EDIT]);
        Permission::create(['name' => User::ROLE_DELETE]);
        Permission::create(['name' => User::ROLE_VIEW]);

        Permission::create(['name' => Post::POST_ACCESS]);
        Permission::create(['name' => Post::POST_CREATE]);
        Permission::create(['name' => Post::POST_EDIT]);
        Permission::create(['name' => Post::POST_DELETE]);
        Permission::create(['name' => Post::POST_VIEW]);

        Permission::create(['name' => Category::CATEGORY_ACCESS]);
        Permission::create(['name' => Category::CATEGORY_CREATE]);
        Permission::create(['name' => Category::CATEGORY_EDIT]);
        Permission::create(['name' => Category::CATEGORY_DELETE]);
        Permission::create(['name' => Category::CATEGORY_VIEW]);


    }
}
