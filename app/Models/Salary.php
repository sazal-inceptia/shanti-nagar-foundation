<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary_slip_number',
        'employee_id',
        'month_year',
        'basic_amount',
        'allowance',
        'bonus',
        'deductions',
        'net_paid_amount',
        'payment_date',
        'payment_method',
        'transaction_reference',
        'status',
        'notes',
    ];

    protected $casts = [
        'basic_amount' => 'decimal:2',
        'allowance' => 'decimal:2',
        'bonus' => 'decimal:2',
        'deductions' => 'decimal:2',
        'net_paid_amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    /**
     * Get the employee who received this salary.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Scope query to a specific Rotary Year (July 1 of start year to June 30 of end year).
     * Example: $query->rotaryYear(2026) covers 2026-07-01 to 2027-06-30.
     */
    public function scopeRotaryYear($query, int $startYear = 2026)
    {
        $startDate = sprintf('%d-07-01', $startYear);
        $endDate = sprintf('%d-06-30', $startYear + 1);

        return $query->whereBetween('payment_date', [$startDate, $endDate]);
    }
}
