<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'spipolije@gmail.com',
            'password' => Hash::make('polijesip'), // ganti password sesuai kebutuhan
            'role' => 'admin', // pastikan tabel users punya kolom 'role'
        ]);
    }
}
