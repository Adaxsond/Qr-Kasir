<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
        ]);

        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@example.com',
            'password' => bcrypt('kasir123'), // ✅ ubah ke password yang sesuai
            'role' => 'kasir', // ✅ ubah ke 'kasir'
            'email_verified_at' => now(),
            'remember_token' => null,
        ]);

        User::factory(10)->create();
    }
}
