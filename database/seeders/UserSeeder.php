<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
    // Use insertOrIgnore so re-running the seeder won't fail on duplicate unique keys
    DB::table('users')->insertOrIgnore([
            [
                'name' => 'Eva Rangers',
                'email' => 'eve.dubois@email.com',
                'password' => Hash::make('secret123'),
                'role' => 'user',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alex Rivera',
                'email' => 'alex.rivera@email.com',
                'password' => Hash::make('secret123'),
                'role' => 'user',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Julie Aot',
                'email' => 'julien@gmail.com',
                'password' => Hash::make('secret123'),
                'role' => 'user',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Super Admin',
                'email' => 'lightadmin@gmail.com',
                'password' => Hash::make('admin123'),
                    'role' => 'admin',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
