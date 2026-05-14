<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'author',
        'location',
        'quote',
        'image_url',
        'order',
        'is_active',
    ];
}
