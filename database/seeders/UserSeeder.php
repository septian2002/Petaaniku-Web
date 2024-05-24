<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),  // Using Hash::make() to hash the password
            'alamat' => '123 Admin Street',
            'level' => 'admin',
            'gambar' => 'default.png', // Assuming a default image is used
            'remember_token' => Str::random(10),
        ]);
    }
}
