<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'Wisata Alam', 'description' => 'Destinasi dengan pemandangan alam indah'],
            ['name' => 'Wisata Budaya', 'description' => 'Lokasi bersejarah dan budaya'],
            ['name' => 'Wisata Kuliner', 'description' => 'Tempat makan dan kuliner'],
            ['name' => 'Wisata Pantai', 'description' => 'Destinasi pantai dan bahari'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
