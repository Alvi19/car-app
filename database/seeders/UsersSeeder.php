<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'address' => '123 Street, City',
            'phone' => '1234567890',
            'driver_license' => 'DL12345',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'address' => '456 Avenue, Town',
            'phone' => '0987654321',
            'driver_license' => 'DL54321',
            'remember_token' => Str::random(10),
        ]);
    }
}
