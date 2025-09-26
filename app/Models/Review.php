<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'author_name',
        'content',
        'rating',
        'source',
        'source_url',
        'featured',
        'active',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'active' => 'boolean',
    ];
}
