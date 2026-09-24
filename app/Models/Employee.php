<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'name',
        'designation',
        'department',
        'phone',
        'email',
        'nid_number',
        'present_address',
        'permanent_address',
        'joining_date',
        'base_salary',
        'employment_status',
        'photo',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'base_salary'  => 'decimal:2',
    ];

    /**
     * Get all salary payment records for this employee.
     */
    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class);
    }
}
