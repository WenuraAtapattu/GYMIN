<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Cardio Equipment
            [
                'name' => 'Professional Treadmill Pro X1',
                'description' => 'High-performance commercial treadmill with advanced cushioning system and powerful motor. Perfect for intensive training sessions.',
                'price' => 2499.99,
                'sale_price' => 2199.99,
                'category' => 'cardio',
                'brand' => 'FitnessPro',
                'model' => 'X1-2024',
                'sku' => 'CARD-001',
                'stock_quantity' => 15,
                'weight' => 120.5,
                'dimensions' => '200cm x 90cm x 150cm',
                'warranty' => '5 years motor, 2 years parts',
                'is_featured' => true,
                'is_active' => true,
                'rating' => 5,
                'review_count' => 24,
                'features' => ['Heart Rate Monitor', 'Bluetooth Connectivity', 'Built-in Programs', 'Shock Absorption'],
                'images' => ['https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'],
                'specifications' => [
                    'Motor' => '4.0 HP',
                    'Speed Range' => '0.5 - 20 mph',
                    'Incline' => '0 - 15%',
                    'Belt Size' => '22" x 60"'
                ]
            ],
            [
                'name' => 'Elite Stationary Bike SB-500',
                'description' => 'Indoor cycling bike with magnetic resistance and performance tracking. Designed for serious cyclists.',
                'price' => 899.99,
                'category' => 'cardio',
                'brand' => 'CycleMaster',
                'model' => 'SB-500',
                'sku' => 'CARD-002',
                'stock_quantity' => 25,
                'weight' => 45.0,
                'dimensions' => '120cm x 55cm x 110cm',
                'warranty' => '3 years frame, 1 year electronics',
                'is_featured' => true,
                'is_active' => true,
                'rating' => 4,
                'review_count' => 18,
                'features' => ['Magnetic Resistance', 'LCD Display', 'Adjustable Seat', 'Transport Wheels'],
                'images' => ['https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'],
                'specifications' => [
                    'Resistance Levels' => '32',
                    'Max User Weight' => '300 lbs',
                    'Flywheel' => '40 lbs'
                ]
            ],

            // Strength Training
            [
                'name' => 'Multi-Station Home Gym System',
                'description' => 'Complete home gym solution with multiple workout stations. Build muscle and strength efficiently.',
                'price' => 1899.99,
                'sale_price' => 1599.99,
                'category' => 'strength',
                'brand' => 'StrengthMax',
                'model' => 'MS-2000',
                'sku' => 'STR-001',
                'stock_quantity' => 8,
                'weight' => 180.0,
                'dimensions' => '250cm x 200cm x 210cm',
                'warranty' => '10 years frame, 2 years cables',
                'is_featured' => true,
                'is_active' => true,
                'rating' => 5,
                'review_count' => 31,
                'features' => ['Lat Pulldown', 'Chest Press', 'Leg Extension', 'Cable System'],
                'images' => ['https://images.unsplash.com/photo-1517963879433-6ad2b056d712?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'],
                'specifications' => [
                    'Weight Stack' => '200 lbs',
                    'Max User Weight' => '350 lbs',
                    'Stations' => '6'
                ]
            ],
            [
                'name' => 'Adjustable Power Rack',
                'description' => 'Heavy-duty power rack with safety bars and pull-up station. Essential for serious strength training.',
                'price' => 799.99,
                'category' => 'strength',
                'brand' => 'IronForce',
                'model' => 'PR-700',
                'sku' => 'STR-002',
                'stock_quantity' => 12,
                'weight' => 95.0,
                'dimensions' => '140cm x 140cm x 220cm',
                'warranty' => 'Lifetime frame warranty',
                'is_featured' => false,
                'is_active' => true,
                'rating' => 4,
                'review_count' => 22,
                'features' => ['Safety Bars', 'Pull-up Station', 'J-Hooks', 'Weight Storage'],
                'specifications' => [
                    'Steel Gauge' => '11 gauge',
                    'Max Weight Capacity' => '1000 lbs',
                    'Height' => 'Adjustable'
                ]
            ],

            // Weights & Dumbbells
            [
                'name' => 'Professional Dumbbell Set (5-50 lbs)',
                'description' => 'Complete rubber hex dumbbell set with rack. Perfect for commercial or home gym use.',
                'price' => 1299.99,
                'sale_price' => 1099.99,
                'category' => 'weights',
                'brand' => 'HexPro',
                'model' => 'HD-SET-50',
                'sku' => 'WGT-001',
                'stock_quantity' => 6,
                'weight' => 275.0,
                'dimensions' => '180cm x 60cm x 120cm',
                'warranty' => '2 years warranty',
                'is_featured' => true,
                'is_active' => true,
                'rating' => 5,
                'review_count' => 45,
                'features' => ['Rubber Coated', 'Hex Design', 'Includes Rack', 'Non-Rolling'],
                'specifications' => [
                    'Weight Range' => '5-50 lbs',
                    'Pairs' => '10 pairs',
                    'Material' => 'Cast Iron with Rubber'
                ]
            ],
            [
                'name' => 'Olympic Barbell Set - 300 lbs',
                'description' => 'Professional Olympic barbell with weight plates. Competition standard equipment.',
                'price' => 449.99,
                'category' => 'weights',
                'brand' => 'OlympicGold',
                'model' => 'OB-300',
                'sku' => 'WGT-002',
                'stock_quantity' => 20,
                'weight' => 136.0,
                'dimensions' => '220cm bar length',
                'warranty' => '5 years warranty',
                'is_featured' => false,
                'is_active' => true,
                'rating' => 4,
                'review_count' => 28,
                'features' => ['Olympic Standard', 'Knurled Grip', 'Rotating Sleeves', 'Weight Plates Included'],
                'specifications' => [
                    'Bar Length' => '7 feet',
                    'Bar Weight' => '45 lbs',
                    'Plate Set' => '255 lbs total'
                ]
            ],

            // Accessories & Gear
            [
                'name' => 'Premium Yoga Mat Set',
                'description' => 'High-quality non-slip yoga mat with accessories. Perfect for yoga, pilates, and stretching.',
                'price' => 79.99,
                'sale_price' => 59.99,
                'category' => 'accessories',
                'brand' => 'YogaLife',
                'model' => 'YM-PREMIUM',
                'sku' => 'ACC-001',
                'stock_quantity' => 50,
                'weight' => 2.5,
                'dimensions' => '183cm x 61cm x 0.6cm',
                'warranty' => '1 year warranty',
                'is_featured' => false,
                'is_active' => true,
                'rating' => 4,
                'review_count' => 67,
                'features' => ['Non-Slip Surface', 'Eco-Friendly', 'Carrying Strap', 'Extra Thick'],
                'specifications' => [
                    'Thickness' => '6mm',
                    'Material' => 'TPE',
                    'Colors' => 'Multiple Available'
                ]
            ],
            [
                'name' => 'Resistance Bands Set',
                'description' => 'Complete resistance bands set with different resistance levels. Portable workout solution.',
                'price' => 39.99,
                'category' => 'accessories',
                'brand' => 'FlexBand',
                'model' => 'RB-COMPLETE',
                'sku' => 'ACC-002',
                'stock_quantity' => 35,
                'weight' => 1.2,
                'dimensions' => '30cm x 20cm x 10cm (packaged)',
                'warranty' => '6 months warranty',
                'is_featured' => false,
                'is_active' => true,
                'rating' => 4,
                'review_count' => 89,
                'features' => ['5 Resistance Levels', 'Door Anchor', 'Handles', 'Ankle Straps'],
                'specifications' => [
                    'Bands' => '5 pieces',
                    'Resistance Range' => '10-50 lbs',
                    'Material' => 'Natural Latex'
                ]
            ],

            // Supplements & Nutrition
            [
                'name' => 'Whey Protein Isolate - Vanilla (5 lbs)',
                'description' => 'Premium whey protein isolate for muscle building and recovery. 90% protein content.',
                'price' => 89.99,
                'sale_price' => 74.99,
                'category' => 'supplements',
                'brand' => 'ProNutrition',
                'model' => 'WPI-VANILLA-5',
                'sku' => 'SUP-001',
                'stock_quantity' => 40,
                'weight' => 2.3,
                'dimensions' => '25cm x 25cm x 30cm',
                'warranty' => 'Best before date guarantee',
                'is_featured' => true,
                'is_active' => true,
                'rating' => 5,
                'review_count' => 156,
                'features' => ['90% Protein', 'Fast Absorption', 'No Artificial Colors', 'Third Party Tested'],
                'specifications' => [
                    'Protein per Serving' => '27g',
                    'Servings' => '74',
                    'Flavors' => 'Vanilla, Chocolate, Strawberry'
                ]
            ],
            [
                'name' => 'Pre-Workout Energy Boost',
                'description' => 'Advanced pre-workout formula for enhanced energy, focus, and performance during workouts.',
                'price' => 49.99,
                'category' => 'supplements',
                'brand' => 'EnergyMax',
                'model' => 'PWO-BOOST',
                'sku' => 'SUP-002',
                'stock_quantity' => 60,
                'weight' => 0.5,
                'dimensions' => '12cm x 12cm x 15cm',
                'warranty' => 'Best before date guarantee',
                'is_featured' => false,
                'is_active' => true,
                'rating' => 4,
                'review_count' => 78,
                'features' => ['Caffeine Free Option', 'Natural Flavors', 'No Crash', 'Beta-Alanine'],
                'specifications' => [
                    'Servings' => '30',
                    'Key Ingredients' => 'Citrulline, Beta-Alanine, Taurine',
                    'Caffeine' => '150mg per serving'
                ]
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
