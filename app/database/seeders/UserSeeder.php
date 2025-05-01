<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a chef user if it doesn't exist
        if (!User::where('email', 'chef@cooknow.com')->exists()) {
            User::create([
                'first_name' => 'Chef',
                'last_name' => 'User',
                'email' => 'chef@cooknow.com',
                'password' => Hash::make('password'),
                'role' => 'chef',
            ]);
        }

        // Create a regular user if it doesn't exist
        if (!User::where('email', 'user@cooknow.com')->exists()) {
            User::create([
                'first_name' => 'Regular',
                'last_name' => 'User',
                'email' => 'user@cooknow.com',
                'password' => Hash::make('password'),
                'role' => 'cooker',
            ]);
        }
    }
}
