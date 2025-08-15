<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            ['name' => 'United Kingdom', 'code' => 'UK', 'slug' => 'united_kingdom'],
            ['name' => 'Nigeria', 'code' => 'NG', 'slug' => 'nigeria']
        ]);
    }
}
