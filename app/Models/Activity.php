<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'title_bn',
        'slug',
        'event_date',
        'event_time',
        'location',
        'location_bn',
        'short_description',
        'short_description_bn',
        'description',
        'description_bn',
        'featured_image',
        'status',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Auto-generate unique slug on create or title change.
     */
    protected static function booted(): void
    {
        static::saving(function (Activity $activity) {
            if (empty($activity->slug) || ($activity->isDirty('title') && ! $activity->isDirty('slug'))) {
                $baseSlug = Str::slug($activity->title);
                $slug = $baseSlug ?: 'activity';
                $counter = 1;
                while (static::where('slug', $slug)->where('id', '!=', $activity->id ?? 0)->exists()) {
                    $slug = $baseSlug.'-'.$counter;
                    $counter++;
                }
                $activity->slug = $slug;
            }
        });
    }

    /**
     * Scope: Only published activities.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope: Featured activities.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: Upcoming or ongoing activities.
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where(function ($q) {
            $q->whereIn('status', ['upcoming', 'ongoing'])
                ->orWhere('event_date', '>=', now()->toDateString());
        });
    }

    /**
     * Scope: Completed activities.
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', 'completed')
            ->orWhere(function ($q) {
                $q->whereNotNull('event_date')->where('event_date', '<', now()->toDateString());
            });
    }

    /**
     * Accessor: Localized title.
     */
    public function getLocalizedTitleAttribute(): string
    {
        return (app()->getLocale() === 'bn' && ! empty($this->title_bn)) ? $this->title_bn : (string) $this->title;
    }

    /**
     * Accessor: Localized location.
     */
    public function getLocalizedLocationAttribute(): ?string
    {
        return (app()->getLocale() === 'bn' && ! empty($this->location_bn)) ? $this->location_bn : $this->location;
    }

    /**
     * Accessor: Localized short description.
     */
    public function getLocalizedShortDescriptionAttribute(): ?string
    {
        return (app()->getLocale() === 'bn' && ! empty($this->short_description_bn)) ? $this->short_description_bn : $this->short_description;
    }

    /**
     * Accessor: Localized full description.
     */
    public function getLocalizedDescriptionAttribute(): ?string
    {
        return (app()->getLocale() === 'bn' && ! empty($this->description_bn)) ? $this->description_bn : $this->description;
    }

    /**
     * Accessor: Resolvable featured image URL.
     */
    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->featured_image && file_exists(public_path($this->featured_image))) {
            return asset($this->featured_image);
        }

        return asset('assets/images/gallery/portfolio-7.jpg');
    }

    /**
     * Badge style based on status.
     */
    public function getStatusBadgeStyleAttribute(): string
    {
        return match ($this->status) {
            'upcoming' => 'background-color: #eff6ff; color: #005daa; border: 1px solid #bfdbfe;',
            'ongoing' => 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;',
            'completed' => 'background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;',
            'cancelled' => 'background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;',
            default => 'background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;',
        };
    }

    /**
     * Status localized label.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'upcoming' => __('Upcoming'),
            'ongoing' => __('Ongoing'),
            'completed' => __('Completed'),
            'cancelled' => __('Cancelled'),
            default => ucfirst((string) $this->status),
        };
    }
}
