<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'lastname' => 'Doe',
            'firstname' => 'John',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'lastname' => 'Super',
            'firstname' => 'Admin',
            'email' => 'contact@vibecro-corp.tech',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);
    }
}
