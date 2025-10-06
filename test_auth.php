<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

try {
    // Test manual authentication
    $credentials = [
        'email' => 'admin@gymin.com',
        'password' => 'password123'
    ];
    
    echo "Testing authentication..." . PHP_EOL;
    
    // Get the user
    $user = User::where('email', $credentials['email'])->first();
    
    if ($user) {
        echo "User found: " . $user->name . PHP_EOL;
        
        // Check password manually
        $passwordValid = Hash::check($credentials['password'], $user->password);
        echo "Password check: " . ($passwordValid ? 'PASS' : 'FAIL') . PHP_EOL;
        
        // Try Auth attempt
        if (Auth::attempt($credentials)) {
            echo "Auth::attempt: SUCCESS" . PHP_EOL;
            echo "Authenticated user: " . Auth::user()->name . PHP_EOL;
        } else {
            echo "Auth::attempt: FAILED" . PHP_EOL;
            
            // More detailed checks
            echo "User attributes:" . PHP_EOL;
            echo "- Email verified: " . ($user->email_verified_at ? 'Yes' : 'No') . PHP_EOL;
            echo "- Is active: " . (method_exists($user, 'isActive') ? ($user->isActive() ? 'Yes' : 'No') : 'Method not found') . PHP_EOL;
            echo "- Password hash: " . substr($user->password, 0, 20) . "..." . PHP_EOL;
        }
    } else {
        echo "User not found!" . PHP_EOL;
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    echo "Stack trace: " . $e->getTraceAsString() . PHP_EOL;
}