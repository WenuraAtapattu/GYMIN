<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'sale_price', 'category', 'brand', 'model',
        'specifications', 'images', 'main_image', 'stock_quantity', 'sku', 'weight', 'dimensions',
        'warranty', 'is_featured', 'is_active', 'rating', 'review_count', 'features', 'condition'
    ];

    protected $casts = [
        'specifications' => 'array',
        'images' => 'array',
        'features' => 'array',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getDisplayPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }

    public function getIsOnSaleAttribute()
    {
        return $this->sale_price && $this->sale_price < $this->price;
    }

    public function getMainImageAttribute()
    {
        $images = $this->images ?? [];
        return $images[0] ?? '/images/products/placeholder.jpg';
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->is_on_sale) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    public function getMainImageUrlAttribute()
    {
        if ($this->main_image) {
            return $this->main_image;
        }
        
        // Fallback to first image in images array
        if ($this->images && is_array($this->images) && count($this->images) > 0) {
            return $this->images[0];
        }
        
        // Default fallback image
        return 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
    }

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class, 'package_id'); // Using package_id temporarily until migration
    }
}
