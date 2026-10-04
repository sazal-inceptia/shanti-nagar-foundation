<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Get a setting value by key with optional fallback.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        $all = self::getAll();

        return $all[$key] ?? $default;
    }

    /**
     * Get a localized setting value based on active application locale.
     */
    public static function getLocalized(string $key, ?string $default = null): ?string
    {
        $all = self::getAll();

        if (app()->getLocale() === 'bn') {
            $bnKey = $key.'_bn';
            if (! empty($all[$bnKey])) {
                return $all[$bnKey];
            }
        }

        return $all[$key] ?? $default;
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, ?string $value, string $group = 'general'): self
    {
        $setting = self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        Cache::forget('site_settings_cache');

        return $setting;
    }

    /**
     * Get all settings as key-value pairs with caching.
     */
    public static function getAll(): array
    {
        try {
            return Cache::remember('site_settings_cache', 3600, function () {
                return self::pluck('value', 'key')->toArray();
            });
        } catch (\Throwable) {
            return [];
        }
    }
}
