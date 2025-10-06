<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkoutRoutine extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'exercises',
        'difficulty_level',
        'duration_minutes',
        'muscle_groups',
        'equipment_needed',
        'is_public',
        'ratings'
    ];

    protected $casts = [
        'exercises' => 'array',
        'muscle_groups' => 'array',
        'equipment_needed' => 'array',
        'is_public' => 'boolean',
        'ratings' => 'decimal:2'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeByDifficulty($query, $level)
    {
        return $query->where('difficulty_level', $level);
    }

    public function scopeByMuscleGroup($query, $muscleGroup)
    {
        return $query->whereJsonContains('muscle_groups', $muscleGroup);
    }
}
