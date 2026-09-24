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
        'basic_amount'    => 'decimal:2',
        'allowance'       => 'decimal:2',
        'bonus'           => 'decimal:2',
        'deductions'      => 'decimal:2',
        'net_paid_amount' => 'decimal:2',
        'payment_date'    => 'date',
    ];

    /**
     * Get the employee who received this salary.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
