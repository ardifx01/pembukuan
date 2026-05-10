<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('admin123'),
            ]
        );

        // Panggil seeder lainnya
        $this->call([
            CategorySeeder::class,
            SupplierSeeder::class,
        ]);
    }
}