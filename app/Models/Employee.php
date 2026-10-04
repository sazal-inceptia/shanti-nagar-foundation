<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'name',
        'name_bn',
        'designation_id',
        'phone',
        'email',
        'nid_number',
        'present_address',
        'permanent_address',
        'joining_date',
        'base_salary',
        'is_active',
        'photo',
        'speech',
        'speech_tag',
        'bio',
        'bio_bn',
        'signature_text',
        'signature_title',
        'badge_title',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'order_index',
        'is_highlight',
    ];

    protected $casts = [
        'designation_id' => 'integer',
        'joining_date' => 'date',
        'base_salary' => 'decimal:2',
        'order_index' => 'integer',
        'is_highlight' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the dynamic designation record.
     */
    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    /**
     * Get dynamic designation display text.
     */
    public function getDesignationNameAttribute(): string
    {
        if (app()->getLocale() === 'bn' && ! empty($this->designation?->name_bn)) {
            return $this->designation->name_bn;
        }

        return $this->designation?->name ?? '—';
    }

    /**
     * Get localized employee name based on active locale.
     */
    public function getLocalizedNameAttribute(): string
    {
        return (app()->getLocale() === 'bn' && ! empty($this->name_bn)) ? $this->name_bn : (string) $this->name;
    }

    /**
     * Get localized employee biography based on active locale.
     */
    public function getLocalizedBioAttribute(): ?string
    {
        return (app()->getLocale() === 'bn' && ! empty($this->bio_bn)) ? $this->bio_bn : $this->bio;
    }

    /**
     * Get localized speech / quote based on active locale.
     */
    public function getLocalizedSpeechAttribute(): ?string
    {
        return (app()->getLocale() === 'bn' && ! empty($this->speech_bn)) ? $this->speech_bn : ($this->speech ? __($this->speech) : null);
    }

    /**
     * Get localized badge title based on active locale.
     */
    public function getLocalizedBadgeTitleAttribute(): ?string
    {
        return $this->badge_title ? __($this->badge_title) : null;
    }

    /**
     * Get localized speech tag based on active locale.
     */
    public function getLocalizedSpeechTagAttribute(): ?string
    {
        return $this->speech_tag ? __($this->speech_tag) : null;
    }

    /**
     * Get localized signature title based on active locale.
     */
    public function getLocalizedSignatureTitleAttribute(): ?string
    {
        return $this->signature_title ? __($this->signature_title) : null;
    }

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

        $bgColors = ['005daa', 'ffb81c', '003366', '009bb0', '0284c7'];
        $color = $bgColors[abs(crc32($empName)) % count($bgColors)];

        $svg = "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' fill='%23{$color}'/><text x='50%' y='54%' dominant-baseline='middle' text-anchor='middle' fill='%23ffffff' font-family='Arial,sans-serif' font-size='38' font-weight='bold'>{$initials}</text></svg>";

        return 'data:image/svg+xml;utf8,'.$svg;
    }
}
