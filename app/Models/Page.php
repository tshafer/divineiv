<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'meta_title',
        'meta_description',
        'featured_image',
        'hero_title',
        'hero_subtitle',
        'action_cards',
        'show_hero_cards',
        'show_contact_sidebar',
        'content_layout',
        'type',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'show_hero_cards' => 'boolean',
        'show_contact_sidebar' => 'boolean',
        'action_cards' => 'array',
    ];
}
