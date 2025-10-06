<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

try {
    $user = User::where('email', 'admin@gymin.com')->first();
    
    if ($user) {
        echo "User found: " . $user->name . PHP_EOL;
        echo "Email: " . $user->email . PHP_EOL;
        echo "Is Admin: " . ($user->is_admin ? 'Yes' : 'No') . PHP_EOL;
        echo "Email Verified: " . ($user->email_verified_at ? 'Yes' : 'No') . PHP_EOL;
        
        // Test password verification
        $testPassword = 'password123';
        $isValid = Hash::check($testPassword, $user->password);
        echo "Password '$testPassword' is valid: " . ($isValid ? 'Yes' : 'No') . PHP_EOL;
        
        if (!$isValid) {
            echo "Updating password hash..." . PHP_EOL;
            $user->update(['password' => Hash::make($testPassword)]);
            echo "Password updated!" . PHP_EOL;
        }
    } else {
        echo "User not found!" . PHP_EOL;
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}