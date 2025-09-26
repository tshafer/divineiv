<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = [
        'title',
        'url',
        'type',
        'target',
        'icon',
        'order',
        'is_active',
        'is_published',
        'css_classes',
        'description',
        'parent_id',
        'level',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_published' => 'boolean',
        'order' => 'integer',
        'level' => 'integer',
    ];

    /**
     * Get the parent menu item
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Get the child menu items
     */
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->where('is_active', true)->where('is_published', true)->orderBy('order');
    }

    /**
     * Get all descendants
     */
    public function descendants(): HasMany
    {
        return $this->children()->with('descendants');
    }

    /**
     * Scope a query to only include published and active menu items
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->where('is_active', true);
    }

    /**
     * Scope a query to only include top-level menu items
     */
    public function scopeParentItems($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope a query to order menu items
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('title');
    }

    /**
     * Get the full URL for the menu item
     */
    public function getFullUrlAttribute(): string
    {
        try {
            return match ($this->type) {
                'route' => $this->resolveRouteUrl(),
                'external' => $this->url,
                default => url($this->url)
            };
        } catch (\Exception $e) {
            return url($this->url);
        }
    }

    /**
     * Resolve route URL - handles page routes with slugs
     */
    protected function resolveRouteUrl(): string
    {
        try {
            // Check if it's a page route with slug
            if (str_starts_with($this->url, 'page.')) {
                $slug = str_replace('page.', '', $this->url);

                return route('page', $slug);
            }

            return route($this->url);
        } catch (\Exception $e) {
            // Fallback to direct URL
            return url('/'.$this->url);
        }
    }

    /**
     * Check if this is a translated menu
     */
    public function isTranslated(): bool
    {
        return str_contains(strtolower($this->title), 'translate');
    }

    /**
     * Check if this is a rewards menu
     */
    public function isRewards(): bool
    {
        return str_contains(strtolower($this->title), 'reward') || str_contains(strtolower($this->title), 'vip');
    }

    /**
     * Check if this menu item is currently active
     */
    public function isActive(): bool
    {
        return \App\Helpers\MenuHelper::isMenuItemActive($this);
    }

    /**
     * Get CSS classes for active state
     */
    public function getActiveClassesAttribute(): string
    {
        return $this->isActive() ? ' text-cyan-300' : '';
    }

    /**
     * Get border effect for active state
     */
    public function getActiveBorderClass(): string
    {
        return $this->isActive() ? 'w-full' : 'w-0';
    }
}
