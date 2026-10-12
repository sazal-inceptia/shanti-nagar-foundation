<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'voucher_number',
        'project_id',
        'expense_category',
        'title',
        'description',
        'amount',
        'expense_date',
        'payment_method',
        'recipient_or_vendor',
        'receipt_voucher_file',
        'created_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
    ];

    /**
     * Get the project associated with this expense.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the user who recorded this expense.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope query to a specific Rotary Year (July 1 of start year to June 30 of end year).
     * Example: $query->rotaryYear(2026) covers 2026-07-01 to 2027-06-30.
     */
    public function scopeRotaryYear($query, int $startYear = 2026)
    {
        $startDate = sprintf('%d-07-01', $startYear);
        $endDate = sprintf('%d-06-30', $startYear + 1);

        return $query->whereBetween('expense_date', [$startDate, $endDate]);
    }

    /**
     * Get resolvable voucher file URL.
     */
    public function getReceiptVoucherUrlAttribute(): ?string
    {
        if (empty($this->receipt_voucher_file)) {
            return null;
        }

        if (file_exists(public_path($this->receipt_voucher_file))) {
            return asset($this->receipt_voucher_file);
        }

        $base = basename($this->receipt_voucher_file);
        if (file_exists(public_path('assets/documents/source-docs/RY-2026-2027/'.$base))) {
            return asset('assets/documents/source-docs/RY-2026-2027/'.$base);
        }

        return asset($this->receipt_voucher_file);
    }
}
