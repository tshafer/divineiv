<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'external_id',
        'author_name',
        'author_avatar_url',
        'content',
        'rating',
        'review_date',
        'source',
        'source_url',
        'external_review_url',
        'featured',
        'active',
        'additional_data',
        'external_sync_at',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'active' => 'boolean',
        'review_date' => 'datetime',
        'external_sync_at' => 'datetime',
        'additional_data' => 'array',
    ];

    /**
     * Scope a query to only include active reviews
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope a query to only include featured reviews
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope a query to filter by source
     */
    public function scopeBySource($query, string $source)
    {
        return $query->where('source', $source);
    }

    /**
     * Scope a query to include reviews from external sources
     */
    public function scopeExternal($query)
    {
        return $query->whereNotNull('external_id');
    }

    /**
     * Check if this review is from an external source
     */
    public function isExternal(): bool
    {
        return ! is_null($this->external_id);
    }

    /**
     * Check if this review was synced from external service
     */
    public function wasSynced(): bool
    {
        return ! is_null($this->external_sync_at);
    }

    /**
     * Get the review source display name
     */
    public function getSourceDisplayNameAttribute(): string
    {
        return match ($this->source) {
            'google' => 'Google Reviews',
            'yelp' => 'Yelp',
            'facebook' => 'Facebook',
            default => ucfirst($this->source ?? 'Unknown')
        };
    }

    /**
     * Get formatted rating display
     */
    public function getFormattedRatingAttribute(): string
    {
        return sprintf('%.1f', $this->rating);
    }

    /**
     * Find existing review by external ID and source
     */
    public static function findByExternalId(string $externalId, string $source): ?Review
    {
        return static::where('external_id', $externalId)
            ->where('source', $source)
            ->first();
    }

    /**
     * Create or update review from external data
     */
    public static function createOrUpdateFromExternal(array $data, string $source): Review
    {
        $externalId = $data['external_id'] ?? null;

        if ($externalId) {
            $existing = static::findByExternalId($externalId, $source);
            if ($existing) {
                $existing->update($data);

                return $existing;
            }
        }

        $data['source'] = $source;
        $data['external_sync_at'] = now();

        return static::create($data);
    }
}
