<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $superAdmin = Role::create(['name' => 'super admin']);

        User::create(
            [
                'name' => 'Super Admin',
                'email' => 'super.admin@mail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        )->assignRole($superAdmin);

        $this->call([
            RoleAndPermissionSeeder::class
        ]);

    }
}
