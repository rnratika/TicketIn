<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@ticketin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Event Organizer',
            'email' => 'eo@ticketin.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@ticketin.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active',
        ]);
    }
}