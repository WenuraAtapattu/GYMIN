<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get test users and products
        $users = User::whereIn('email', ['test@example.com', 'john@example.com', 'jane@example.com'])->get();
        $products = Product::limit(10)->get();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        $statuses = ['pending', 'processing', 'completed', 'cancelled'];
        $paymentStatuses = ['pending', 'paid', 'failed'];
        $paymentMethods = ['credit_card', 'paypal', 'bank_transfer'];

        foreach ($users as $user) {
            // Create 3-8 orders per user
            $orderCount = rand(3, 8);
            
            for ($i = 0; $i < $orderCount; $i++) {
                $product = $products->random();
                $quantity = rand(1, 3);
                $priceAtTime = $product->sale_price ?? $product->price;
                $totalAmount = $priceAtTime * $quantity;
                
                $status = $statuses[array_rand($statuses)];
                $paymentStatus = $status === 'completed' ? 'paid' : $paymentStatuses[array_rand($paymentStatuses)];
                
                Order::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'order_number' => 'GYM-' . strtoupper(uniqid()),
                    'total_amount' => $totalAmount,
                    'status' => $status,
                    'payment_status' => $paymentStatus,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'order_details' => [
                        'product_name' => $product->name,
                        'quantity' => $quantity,
                        'price_per_item' => $priceAtTime,
                        'total_amount' => $totalAmount
                    ],
                    'created_at' => now()->subDays(rand(0, 60)),
                    'updated_at' => now()->subDays(rand(0, 30)),
                ]);
            }
        }
    }
}
