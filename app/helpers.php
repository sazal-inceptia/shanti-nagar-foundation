<?php

use App\Models\Setting;

if (! function_exists('site_setting')) {
    /**
     * Get a localized site setting.
     */
    function site_setting(string $key, ?string $default = null): ?string
    {
        return Setting::getLocalized($key, $default);
    }
}

if (! function_exists('is_bengali')) {
    /**
     * Check if the active application locale is Bengali.
     */
    function is_bengali(): bool
    {
        return app()->getLocale() === 'bn';
    }
}

if (! function_exists('bengali_number')) {
    /**
     * Convert English digits to Bengali digits.
     */
    function bengali_number(int|float|string|null $number): string
    {
        if ($number === null) {
            return '';
        }

        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bn = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        return str_replace($en, $bn, (string) $number);
    }
}

if (! function_exists('localized_number')) {
    /**
     * Format a number and optionally convert to Bengali digits based on current locale.
     */
    function localized_number(int|float|string|null $number, int $decimals = 0): string
    {
        if ($number === null) {
            return '';
        }

        $formatted = is_numeric($number) ? number_format((float) $number, $decimals) : (string) $number;

        if (is_bengali()) {
            return bengali_number($formatted);
        }

        return $formatted;
    }
}
