<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([

            'name' => 'Administrator',

            'student_id' => 'ADMIN001',

            'email' => 'admin@uitm.com',

            'password' => Hash::make('password123'),

            'phone_number' => '0123456789',

            'role' => 'admin',

        ]);
    }
}