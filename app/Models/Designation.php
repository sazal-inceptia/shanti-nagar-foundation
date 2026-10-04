<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_bn',
        'slug',
        'category',
        'order_index',
        'is_active',
    ];

    protected $casts = [
        'order_index' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get localized designation name based on active locale.
     */
    public function getLocalizedNameAttribute(): string
    {
        return (app()->getLocale() === 'bn' && ! empty($this->name_bn)) ? $this->name_bn : (string) $this->name;
    }

    /**
     * Boot model events to auto-generate slug if not provided.
     */
    protected static function booted(): void
    {
        static::creating(function (Designation $designation) {
            if (empty($designation->slug) && ! empty($designation->name)) {
                $designation->slug = Str::slug($designation->name);
            }
        });
    }

    /**
     * Get all employees associated with this designation.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
