<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'id' => 1,
            'name' => 'Obat',
            'created_at' => '2023-10-10 09:45:40',
            'updated_at' => '2023-10-10 09:45:40'
        ]);


        ProductCategory::create([
            'id' => 2,
            'name' => 'Alat Kesehatan',
            'created_at' => '2023-10-10 09:45:40',
            'updated_at' => '2023-10-10 09:45:40'
        ]);
    }
}
