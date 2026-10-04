<?php

namespace App\Models;

use App\Enums\DonorType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
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
        'donor_type' => DonorType::class,
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

    /**
     * Get dynamic avatar URL for donor.
     */
    public function getAvatarUrlAttribute(): string
    {
        if (! empty($this->image)) {
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }
            if (file_exists(public_path($this->image))) {
                return asset($this->image);
            }
            if (file_exists(public_path('storage/'.$this->image))) {
                return asset('storage/'.$this->image);
            }
            if (str_starts_with($this->image, 'storage/')) {
                return asset($this->image);
            }

            return asset($this->image);
        }

        if (! empty($this->photo) && file_exists(public_path($this->photo))) {
            return asset($this->photo);
        }

        $donorName = trim($this->name ?: ($this->is_anonymous ? 'Well-wisher' : 'Donor'));
        $words = preg_split('/\s+/', $donorName);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $w) {
            $initials .= mb_strtoupper(mb_substr($w, 0, 1));
        }
        $initials = $initials ?: 'D';

        $bgColors = ['005daa', 'ffb81c', '003366', '009bb0', '0284c7'];
        $color = $bgColors[abs(crc32($donorName)) % count($bgColors)];

        $svg = "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' fill='%23{$color}'/><text x='50%' y='54%' dominant-baseline='middle' text-anchor='middle' fill='%23ffffff' font-family='Arial,sans-serif' font-size='38' font-weight='bold'>{$initials}</text></svg>";

        return 'data:image/svg+xml;utf8,'.$svg;
    }
}
