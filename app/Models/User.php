<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'image',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get user avatar or auto-generated SVG initials.
     */
    public function getAvatarUrlAttribute(): string
    {
        if (! empty($this->image) && file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        $initials = strtoupper(substr(trim($this->name ?: 'Admin'), 0, 1));

        $svg = sprintf(
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100%%" height="100%%"><rect width="100" height="100" fill="#005daa"/><text x="50%%" y="55%%" dominant-baseline="middle" text-anchor="middle" fill="#ffffff" font-family="system-ui, -apple-system, sans-serif" font-size="44" font-weight="700">%s</text></svg>',
            htmlspecialchars($initials)
        );

        return 'data:image/svg+xml;utf8,'.rawurlencode($svg);
    }

    /**
     * Expenses recorded/created by this user.
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'created_by');
    }
}
