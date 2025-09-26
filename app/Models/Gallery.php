<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_url',
        'thumbnail_url',
        'alt_text',
        'sort_order',
        'featured',
        'active',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'active' => 'boolean',
    ];
}
