<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'admin',
            'role' => 1,
            'birth_date' => '2002-08-26',
            'gender' => 'Male',
            'address' => 'JL. Bendul Merisi Selatan V No.3',
            'city' => 'Surabaya',
            'contact' => '089502869186',
            'email' => '20081010107@student.upnjatim.ac.id',
            'paypal_id' => '1234',
            'image' => NULL,
            'email_verified_at' => NULL,
            'password' => '$2y$10$tcirwHa1m7O1DybhngXKNO3NPL3akrizn12qakYbzf2nowMfkMC9u',
            'remember_token' => NULL,
            'created_at' => '2023-10-10 01:55:21',
            'updated_at' => '2023-10-15 11:05:02'
        ]);

        User::create([
            'id' => 2,
            'name' => 'Muhammad Syaugi Shahab',
            'role' => 0,
            'birth_date' => '2002-08-26',
            'gender' => 'Male',
            'address' => 'Jl. Bendul Merisi Selatan V No.3',
            'city' => 'Surabaya',
            'contact' => '089502869183',
            'email' => 'm.syaugishahab@gmail.com',
            'paypal_id' => '34123113',
            'image' => 'jCeqeR45mMPpUqfIpPCxGPYcg3Mc03TgNqGACEKG.png',
            'email_verified_at' => NULL,
            'password' => '$2y$10$EnCkqk7QyEV6ZMsM1eflaO8KGAn3DAfMcv0Apy2/vmG3zHkHYzVwi',
            'remember_token' => NULL,
            'created_at' => '2023-10-17 18:56:47',
            'updated_at' => '2023-10-19 07:54:09'
        ]);
    }
}
