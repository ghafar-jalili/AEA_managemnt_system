<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@afg.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@afg.com',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // Create Teacher User
        User::firstOrCreate(
            ['email' => 'teacher@afg.com'],
            [
                'name' => 'Test Teacher',
                'email' => 'teacher@afg.com',
                'role' => 'teacher',
                'password' => Hash::make('teacher123'),
            ]
        );

        // Create Student User
        User::firstOrCreate(
            ['email' => 'student@afg.com'],
            [
                'name' => 'Test Student',
                'email' => 'student@afg.com',
                'role' => 'student',
                'password' => Hash::make('student123'),
            ]
        );
    }
}
