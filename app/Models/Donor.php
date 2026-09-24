<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'donor_type',
        'is_anonymous',
        'notes',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];

    /**
     * Get all donations made by this donor.
     */
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Total amount contributed by this donor.
     */
    public function getTotalDonationAttribute(): float
    {
        return (float) $this->donations()->where('status', 'completed')->sum('amount');
    }
}
