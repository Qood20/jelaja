<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Jelaja
        User::updateOrCreate(
            ['email' => 'admin@jelaja.test'],
            [
                'name' => 'Admin Jelaja',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
        );

        // Dua operator wisata
        User::updateOrCreate(
            ['email' => 'operator1@jelaja.test'],
            [
                'name' => 'Operator Nusantara Park',
                'password' => Hash::make('password'),
                'role' => 'operator',
            ],
        );

        User::updateOrCreate(
            ['email' => 'operator2@jelaja.test'],
            [
                'name' => 'Operator Pantai Cantik',
                'password' => Hash::make('password'),
                'role' => 'operator',
            ],
        );

        // Dua buyer
        User::updateOrCreate(
            ['email' => 'buyer1@jelaja.test'],
            [
                'name' => 'Pembeli Satu',
                'password' => Hash::make('password'),
                'role' => 'buyer',
            ],
        );

        User::updateOrCreate(
            ['email' => 'buyer2@jelaja.test'],
            [
                'name' => 'Pembeli Dua',
                'password' => Hash::make('password'),
                'role' => 'buyer',
            ],
        );
    }
}

