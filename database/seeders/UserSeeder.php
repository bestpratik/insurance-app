<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only create if doesn't exist
        if (!DB::table('users')->where('email', 'devadmin@gmail.com')->exists()) {
            $adminId = DB::table('users')->insertGetId([
                'name' => 'System Administrator',
                'email' => 'devadmin@gmail.com',
                'password' => Hash::make('Admin123!'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
