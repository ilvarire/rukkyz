<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CouponSeeder::class,
            CountrySeeder::class,
            CategorySeeder::class

        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 2,
            'password' => 'password123'
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'role' => 1,
            'password' => 'password123'
        ]);
    }
}