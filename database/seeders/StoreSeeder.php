<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'id' => 1,
            'name' => 'K24Klik ',
            'address' => 'Jl. Rungkut Mejoyo No. 12 (Lama : Jl. Tenggilis Mejoyo Blok G-6) Surabaya',
            'user_id' => 1,
            'created_at' => '2023-10-10 09:50:46',
            'updated_at' => '2023-10-10 09:50:46'
        ]);
    }
}
