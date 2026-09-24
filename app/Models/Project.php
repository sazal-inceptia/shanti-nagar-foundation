<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'short_description',
        'description',
        'estimated_cost',
        'total_expense',
        'start_date',
        'completion_date',
        'status',
        'location',
        'featured_image',
        'is_featured',
        'is_published',
    ];

    protected $casts = [
        'estimated_cost' => 'decimal:2',
        'total_expense'  => 'decimal:2',
        'start_date'     => 'date',
        'completion_date'=> 'date',
        'is_featured'    => 'boolean',
        'is_published'   => 'boolean',
    ];

    /**
     * Get all images / documentation photos for this project.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    /**
     * Get all donations allocated to this project.
     */
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get all expenses incurred for this project.
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Total donations raised for this project.
     */
    public function getTotalDonationsRaisedAttribute(): float
    {
        return (float) $this->donations()->where('status', 'completed')->sum('amount');
    }

    /**
     * Total actual expenses spent on this project.
     */
    public function getActualExpenseTotalAttribute(): float
    {
        return (float) $this->expenses()->sum('amount');
    }
}
