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
        'base_salary' => 'decimal:2',
    ];

    /**
     * Get all salary payment records for this employee.
     */
    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class);
    }

    /**
     * Get dynamic photo URL for employee.
     */
    public function getPhotoUrlAttribute(): string
    {
        if (! empty($this->photo)) {
            if (str_starts_with($this->photo, 'http://') || str_starts_with($this->photo, 'https://')) {
                return $this->photo;
            }
            if (file_exists(public_path($this->photo))) {
                return asset($this->photo);
            }
            if (file_exists(public_path('storage/'.$this->photo))) {
                return asset('storage/'.$this->photo);
            }
            if (str_starts_with($this->photo, 'storage/')) {
                return asset($this->photo);
            }

            return asset($this->photo);
        }

        $empName = trim($this->name ?: 'Employee');
        $words = preg_split('/\s+/', $empName);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $w) {
            $initials .= mb_strtoupper(mb_substr($w, 0, 1));
        }
        $initials = $initials ?: 'E';

        $bgColors = ['f65024', '03c0a8', '2b59ff', '7c3aed', 'ea580c', '0d9488'];
        $color = $bgColors[abs(crc32($empName)) % count($bgColors)];

        $svg = "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' fill='%23{$color}'/><text x='50%' y='54%' dominant-baseline='middle' text-anchor='middle' fill='%23ffffff' font-family='Arial,sans-serif' font-size='38' font-weight='bold'>{$initials}</text></svg>";

        return 'data:image/svg+xml;utf8,'.$svg;
    }
}
