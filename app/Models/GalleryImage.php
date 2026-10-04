<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'title',
        'title_bn',
        'caption',
        'caption_bn',
        'image_path',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeWithoutAlbum(Builder $query): Builder
    {
        return $query->whereNull('album_id');
    }

    public function getLocalizedTitleAttribute(): ?string
    {
        if (function_exists('is_bengali') && is_bengali() && ! empty($this->title_bn)) {
            return $this->title_bn;
        }

        return $this->title;
    }

    public function getLocalizedCaptionAttribute(): ?string
    {
        if (function_exists('is_bengali') && is_bengali() && ! empty($this->caption_bn)) {
            return $this->caption_bn;
        }

        return $this->caption;
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image_path)) {
            return asset('assets/images/gallery/portfolio-7.jpg');
        }

        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://') || str_starts_with($this->image_path, 'assets/')) {
            return asset($this->image_path);
        }

        return asset('storage/'.$this->image_path);
    }
}
