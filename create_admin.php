<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

try {
    // Delete existing admin user first
    User::where('email', 'admin@gymin.com')->delete();
    
    // Create fresh admin user
    $adminUser = User::create([
        'name' => 'Admin User',
        'email' => 'admin@gymin.com',
        'password' => Hash::make('password123'),
        'email_verified_at' => now(),
        'is_admin' => true,
    ]);
    
    echo "Fresh admin user created successfully!\n";
    echo "Email: admin@gymin.com\n";
    echo "Password: password123\n";
    
    // Verify the user was created correctly
    $verify = User::where('email', 'admin@gymin.com')->first();
    echo "Verification - User ID: " . $verify->id . "\n";
    echo "Verification - Is Admin: " . ($verify->is_admin ? 'Yes' : 'No') . "\n";
    echo "Verification - Email Verified: " . ($verify->email_verified_at ? 'Yes' : 'No') . "\n";
    
    // Create some sample data if needed
    if (\App\Models\Package::count() == 0) {
        \App\Models\Package::create([
            'name' => 'Basic Fitness Package',
            'price' => 49.99,
            'description' => 'Basic fitness package with essential workouts and nutrition guidelines.',
            'category' => 'fitness',
            'duration_months' => 1,
            'discount_percentage' => 0,
            'features' => ['Basic workout routines', 'Nutrition guidelines'],
            'is_active' => true
        ]);
        
        \App\Models\Package::create([
            'name' => 'Premium Training Package',
            'price' => 99.99,
            'description' => 'Premium package with personal training and custom diet plans.',
            'category' => 'premium',
            'duration_months' => 3,
            'discount_percentage' => 10,
            'features' => ['Personal trainer', 'Custom diet plan', 'Progress tracking'],
            'is_active' => true
        ]);
        
        echo "Sample packages created!\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}