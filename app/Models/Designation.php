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
