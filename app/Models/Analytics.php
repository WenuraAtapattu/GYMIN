<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as MongoModel;

class Analytics extends MongoModel
{
    protected $connection = 'mongodb';
    protected $collection = 'analytics';

    protected $fillable = [
        'user_id',
        'event_type',
        'event_data',
        'session_id',
        'ip_address',
        'user_agent',
        'timestamp',
        'page_url',
        'referrer'
    ];

    protected $casts = [
        'event_data' => 'array',
        'timestamp' => 'datetime'
    ];

    // Static methods for different analytics events
    public static function trackPageView($data)
    {
        return static::create([
            'event_type' => 'page_view',
            'event_data' => $data,
            'timestamp' => now()
        ]);
    }

    public static function trackPurchase($data)
    {
        return static::create([
            'event_type' => 'purchase',
            'event_data' => $data,
            'timestamp' => now()
        ]);
    }

    public static function trackWorkoutComplete($data)
    {
        return static::create([
            'event_type' => 'workout_complete',
            'event_data' => $data,
            'timestamp' => now()
        ]);
    }
}
