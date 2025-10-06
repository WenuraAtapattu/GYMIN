<?php

namespace Database\Seeders;

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
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@gymin.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@gymin.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        echo "Admin user created successfully!\n";
        echo "Email: admin@gymin.com\n";
        echo "Password: admin123\n";
    }
}