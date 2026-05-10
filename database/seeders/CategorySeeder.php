<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Kursi', 'slug' => 'kursi'],
            ['name' => 'Meja', 'slug' => 'meja'],
            ['name' => 'Lemari', 'slug' => 'lemari'],
            ['name' => 'Tempat Tidur', 'slug' => 'tempat-tidur'],
            ['name' => 'Sofa', 'slug' => 'sofa'],
            ['name' => 'Rak Buku', 'slug' => 'rak-buku'],
            ['name' => 'Meja Kerja', 'slug' => 'meja-kerja'],
            ['name' => 'Kursi Kantor', 'slug' => 'kursi-kantor'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}