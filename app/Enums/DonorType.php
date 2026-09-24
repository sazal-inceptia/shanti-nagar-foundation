<?php

namespace App\Enums;

enum DonorType: string
{
    case Individual = 'individual';
    case Organization = 'organization';
    case Corporate = 'corporate';
    case Anonymous = 'anonymous';

    /**
     * Get human-friendly label for display.
     */
    public function label(): string
    {
        return match ($this) {
            self::Individual => 'Individual Citizen',
            self::Organization => 'Social Welfare Trust / NGO',
            self::Corporate => 'Corporate & Business',
            self::Anonymous => 'Anonymous / Well-wisher',
        };
    }

    /**
     * Get UI badge style colors.
     */
    public function badgeStyle(): string
    {
        return match ($this) {
            self::Individual => 'background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;',
            self::Organization => 'background-color: #f5f3ff; color: #5b21b6; border: 1px solid #ddd6fe;',
            self::Corporate => 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;',
            self::Anonymous => 'background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;',
        };
    }

    /**
     * Get array map of [value => label] for dropdowns.
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }

    /**
     * Get array of all string values.
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
