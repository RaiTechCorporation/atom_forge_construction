<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstructionPlan extends Model
{
    protected $fillable = [
        'name',
        'price_per_sqft',
        'features',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean'
    ];
}
