<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@ticketin.com',
            'password' => Hash::make('password'), // passwordnya: password
            'role' => 'admin',
            'status' => 'active',
        ]);

        // 2. Create Organizer (Contoh)
        User::create([
            'name' => 'Event Organizer 1',
            'email' => 'eo@ticketin.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
            'status' => 'active', // Langsung aktif untuk testing
        ]);

        // 3. Create User (Contoh)
        User::create([
            'name' => 'Pengunjung',
            'email' => 'user@ticketin.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active',
        ]);
    }
}