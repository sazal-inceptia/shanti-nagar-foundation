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
        'amount'       => 'decimal:2',
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
}
