<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price_at_time'
    ];

    protected $casts = [
        'price_at_time' => 'decimal:2'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Accessors
    public function getTotalPriceAttribute()
    {
        // Use the price at time of adding to cart, or fallback to current product price
        if ($this->price_at_time) {
            return $this->quantity * $this->price_at_time;
        }
        
        $product = $this->product;
        if (!$product) {
            return 0;
        }
        $price = $product->sale_price ?? $product->price;
        return $this->quantity * $price;
    }
}
