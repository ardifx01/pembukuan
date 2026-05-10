<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Supplier::query()->delete();
        
        $suppliers = [
            [
                'name' => 'PT. Furnindo Utama',
                'contact_person' => 'Budi Santoso',
                'phone' => '081234567890',
                'email' => 'info@furnindoutama.com',
                'address' => 'Jl. Industri Raya No. 123, Jakarta Timur',
            ],
            [
                'name' => 'CV. Mebel Jaya',
                'contact_person' => 'Siti Aminah',
                'phone' => '087812345678',
                'email' => 'cs@mebeljaya.co.id',
                'address' => 'Jl. Raya Jepara No. 45, Jepara',
            ],
            [
                'name' => 'UD. Sumber Rejeki',
                'contact_person' => 'Ahmad Syarif',
                'phone' => '085678901234',
                'email' => 'sumberrejeki@gmail.com',
                'address' => 'Jl. Veteran No. 78, Surabaya',
            ],
            [
                'name' => 'PT. Indo Furniture Express',
                'contact_person' => 'Dewi Permata',
                'phone' => '082134567890',
                'email' => 'sales@indoexpress.com',
                'address' => 'Jl. Gatot Subroto Km 5, Bandung',
            ],
            [
                'name' => 'CV. Karya Anak Bangsa',
                'contact_person' => 'Rizki Firmansyah',
                'phone' => '089876543210',
                'email' => 'karyaanakbangsa@yahoo.com',
                'address' => 'Jl. Pangeran Antasari No. 12, Medan',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}