<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // ✅ ubah ke password yang sesuai
            'role' => 'admin', // ✅ ubah ke 'admin'
            'email_verified_at' => now(),
            'remember_token' => null,
        ]);
    }
}
