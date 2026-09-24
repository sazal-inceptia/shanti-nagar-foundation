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
        'total_expense' => 'decimal:2',
        'start_date' => 'date',
        'completion_date' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
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
     * Total donations raised for this project (completed donations).
     */
    public function getTotalDonationsRaisedAttribute(): float
    {
        if ($this->relationLoaded('donations')) {
            return (float) $this->donations->where('status', 'completed')->sum('amount');
        }

        return (float) $this->donations()->where('status', 'completed')->sum('amount');
    }

    /**
     * Total actual expenses spent on this project.
     * Uses relational expenses sum if available, falls back to total_expense column.
     */
    public function getActualExpenseTotalAttribute(): float
    {
        if ($this->relationLoaded('expenses')) {
            $sum = (float) $this->expenses->sum('amount');

            return $sum > 0 ? $sum : (float) $this->total_expense;
        }
        $sum = (float) $this->expenses()->sum('amount');

        return $sum > 0 ? $sum : (float) $this->total_expense;
    }

    /**
     * Net balance remaining from funds raised after expenses.
     */
    public function getNetBalanceAttribute(): float
    {
        return (float) ($this->total_donations_raised - $this->actual_expense_total);
    }

    /**
     * Remaining target budget to be spent.
     */
    public function getRemainingBudgetAttribute(): float
    {
        return (float) max(0, $this->estimated_cost - $this->actual_expense_total);
    }

    /**
     * Calculate percentage of target budget raised.
     */
    public function getFundingProgressPercentageAttribute(): float
    {
        if ((float) $this->estimated_cost <= 0) {
            return 0;
        }

        return round(($this->total_donations_raised / (float) $this->estimated_cost) * 100, 1);
    }
}
