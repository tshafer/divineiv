<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompleteDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding complete Divine IV and Wellness data...');

        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@divineiv.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Run existing seeders to get all data
        $this->call([
            ServiceSeeder::class,
            ReviewSeeder::class,
            PageSeeder::class,
            MenuSeeder::class,
        ]);
    }
}
