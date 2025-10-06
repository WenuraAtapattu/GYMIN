<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SetAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:set-admin {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set a user as admin or create admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        if (!$email) {
            // If no email provided, create default admin
            $email = 'admin@gymin.com';
            $name = 'Admin User';
            $password = 'admin123';
            
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make($password),
                    'email_verified_at' => now(),
                ]
            );
        } else {
            $user = User::where('email', $email)->first();
            
            if (!$user) {
                $this->error("User with email {$email} not found!");
                return 1;
            }
        }
        
        $user->update(['is_admin' => true]);
        
        $this->info("User {$user->email} is now an admin!");
        $this->info("You can login with:");
        $this->info("Email: {$user->email}");
        if (!$this->argument('email')) {
            $this->info("Password: admin123");
        }
        
        return 0;
    }
}
