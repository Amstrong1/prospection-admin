<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Structure;
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

        Structure::factory()->create([
            'name' => 'Vibecro Corporation',
            'email' => 'contact@vibecro-corp.tech',
            'tel' => '55695656',
            'address' => Hash::make('password'),
            'logo' => 'logo.png',
        ]);

        User::factory()->create([
            'structure_id' => 1,
            'lastname' => 'Super',
            'firstname' => 'Admin',
            'email' => 'contact@vibecro-corp.tech',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);
    }
}
