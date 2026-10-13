<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_bn',
        'slug',
        'description',
        'description_bn',
        'cover_image',
        'event_date',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($album) {
            if (empty($album->slug)) {
                $album->slug = Str::slug($album->title);
            }
        });
    }

    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class)->orderBy('sort_order')->latest();
    }

    public function activeImages(): HasMany
    {
        return $this->hasMany(GalleryImage::class)->where('is_active', true)->orderBy('sort_order')->latest();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope query to a specific Rotary Year (July 1 to June 30).
     */
    public function scopeRotaryYear(Builder $query, int $startYear = 2026): Builder
    {
        $startDate = sprintf('%d-07-01', $startYear);
        $endDate = sprintf('%d-06-30', $startYear + 1);

        return $query->whereBetween('event_date', [$startDate, $endDate]);
    }

    public function getLocalizedTitleAttribute(): string
    {
        if (function_exists('is_bengali') && is_bengali() && ! empty($this->title_bn)) {
            return $this->title_bn;
        }

        return $this->title ?? '';
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        if (function_exists('is_bengali') && is_bengali() && ! empty($this->description_bn)) {
            return $this->description_bn;
        }

        return $this->description;
    }

    public function getCoverImageUrlAttribute(): string
    {
        if (empty($this->cover_image)) {
            $firstImage = $this->images()->first();
            if ($firstImage) {
                return $firstImage->image_url;
            }

            return asset('assets/images/standalone/hero-club-fellowship-portrait.jpeg');
        }

        if (str_starts_with($this->cover_image, 'http://') || str_starts_with($this->cover_image, 'https://') || str_starts_with($this->cover_image, 'assets/')) {
            return asset($this->cover_image);
        }

        return asset('storage/'.$this->cover_image);
    }
}
