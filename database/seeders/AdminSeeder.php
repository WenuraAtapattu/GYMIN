<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gymin.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'is_admin' => true,
            'is_trainer' => true,
            'phone' => '+1234567890',
            'gender' => 'male',
            'fitness_goals' => ['manage_gym', 'help_members']
        ]);

        echo "Admin user created:\n";
        echo "Email: admin@gymin.com\n";
        echo "Password: admin123\n";
    }
}
