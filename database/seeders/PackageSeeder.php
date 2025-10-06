<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Basic Fitness',
                'description' => 'Perfect for beginners starting their fitness journey. Includes access to basic equipment and group classes.',
                'price' => 29.99,
                'duration_months' => 1,
                'features' => [
                    'Gym access during peak hours',
                    'Basic equipment usage',
                    'Group fitness classes',
                    'Locker room access',
                    'Fitness assessment'
                ],
                'category' => 'basic',
                'is_active' => true,
                'discount_percentage' => 0
            ],
            [
                'name' => 'Premium Membership',
                'description' => 'Comprehensive package with personal training sessions and advanced equipment access.',
                'price' => 59.99,
                'duration_months' => 1,
                'features' => [
                    'All Basic features',
                    '24/7 gym access',
                    'Personal training sessions (2/month)',
                    'Advanced equipment access',
                    'Nutrition consultation',
                    'Guest passes (2/month)',
                    'Pool and sauna access'
                ],
                'category' => 'premium',
                'is_active' => true,
                'discount_percentage' => 15
            ],
            [
                'name' => 'Elite Performance',
                'description' => 'Ultimate package for serious athletes with unlimited personal training and specialized programs.',
                'price' => 99.99,
                'duration_months' => 1,
                'features' => [
                    'All Premium features',
                    'Unlimited personal training',
                    'Specialized sports programs',
                    'Recovery services (massage)',
                    'Meal planning service',
                    'Priority class booking',
                    'Private locker',
                    'Supplement discounts'
                ],
                'category' => 'elite',
                'is_active' => true,
                'discount_percentage' => 20
            ],
            [
                'name' => 'Annual Basic',
                'description' => 'Save big with our annual basic membership plan!',
                'price' => 299.99,
                'duration_months' => 12,
                'features' => [
                    'All Basic Fitness features',
                    'Best value for money',
                    'No monthly fees',
                    'Member appreciation events',
                    'Freeze membership option'
                ],
                'category' => 'basic',
                'is_active' => true,
                'discount_percentage' => 25
            ],
            [
                'name' => 'Personal Trainer Package',
                'description' => 'Work one-on-one with certified trainers to achieve your specific goals.',
                'price' => 149.99,
                'duration_months' => 1,
                'features' => [
                    'Dedicated personal trainer',
                    'Customized workout plans',
                    'Progress tracking',
                    'Nutrition guidance',
                    'Flexible scheduling',
                    'Goal-oriented programs'
                ],
                'category' => 'trainer',
                'is_active' => true,
                'discount_percentage' => 10
            ],
            [
                'name' => 'Student Special',
                'description' => 'Affordable fitness solution for students with valid ID.',
                'price' => 19.99,
                'duration_months' => 1,
                'features' => [
                    'Basic gym access',
                    'Student discount',
                    'Group classes',
                    'Study-friendly hours',
                    'Flexible cancellation'
                ],
                'category' => 'basic',
                'is_active' => true,
                'discount_percentage' => 35
            ]
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
