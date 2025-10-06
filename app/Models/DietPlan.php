<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DietPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'goal_type',
        'total_calories',
        'macros',
        'meal_plans',
        'duration_weeks',
        'is_public',
        'created_by_trainer'
    ];

    protected $casts = [
        'macros' => 'array', // protein, carbs, fats percentages
        'meal_plans' => 'array',
        'is_public' => 'boolean',
        'created_by_trainer' => 'boolean'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mealPlans()
    {
        return $this->hasMany(MealPlan::class);
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeByGoal($query, $goal)
    {
        return $query->where('goal_type', $goal);
    }
}
