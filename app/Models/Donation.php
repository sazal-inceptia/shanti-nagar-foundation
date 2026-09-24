<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'receipt_number',
        'donor_id',
        'project_id',
        'amount',
        'currency',
        'payment_method',
        'transaction_id',
        'donation_date',
        'purpose',
        'status',
        'notes',
    ];

    protected $casts = [
        'amount'        => 'decimal:2',
        'donation_date' => 'date',
    ];

    /**
     * Get the donor who made this donation.
     */
    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }

    /**
     * Get the project associated with this donation (if specified).
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
