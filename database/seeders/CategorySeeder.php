<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'rice', 'slug' => 'rice', 'image_url' => 'test/url'],
            ['name' => 'soup', 'slug' => 'soup', 'image_url' => 'test/url'],
            ['name' => 'meat', 'slug' => 'meat', 'image_url' => 'test/url']
        ]);
    }
}
