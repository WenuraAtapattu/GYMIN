<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'diet_plan_id',
        'name',
        'meal_type',
        'foods',
        'total_calories',
        'macros',
        'preparation_time',
        'instructions',
        'ingredients'
    ];

    protected $casts = [
        'foods' => 'array',
        'macros' => 'array',
        'ingredients' => 'array',
        'instructions' => 'array'
    ];

    // Relationships
    public function dietPlan()
    {
        return $this->belongsTo(DietPlan::class);
    }

    // Scopes
    public function scopeByMealType($query, $type)
    {
        return $query->where('meal_type', $type);
    }
}
