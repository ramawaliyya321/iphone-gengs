<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rama',
            'email' => 'rama@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'arya',
            'email' => 'arya@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'anggota',
        ]);

        User::create([
            'name' => 'satya',
            'email' => 'satya@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'anggota',
        ]);

        User::create([
            'name' => 'adhit',
            'email' => 'adhit@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'anggota',
        ]);
        
        User::create([
            'name' => 'dhika',
            'email' => 'dhika@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'anggota',
        ]);
    }
}
