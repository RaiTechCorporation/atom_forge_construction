<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'featured_image',
        'featured_video_url',
        'featured_video_file',
        'content',
        'meta_title',
        'meta_description',
        'keywords',
        'tags',
        'faq',
        'is_published',
    ];

    protected $casts = [
        'tags' => 'array',
        'faq' => 'array',
        'is_published' => 'boolean',
    ];
}
