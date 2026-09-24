<?php

namespace App\Enums;

enum EmploymentStatus: string
{
    case Active = 'active';
    case OnLeave = 'on_leave';
    case Resigned = 'resigned';
    case Terminated = 'terminated';

    /**
     * Human-friendly label for display.
     */
    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active Staff',
            self::OnLeave => 'On Leave',
            self::Resigned => 'Resigned',
            self::Terminated => 'Terminated',
        };
    }

    /**
     * Visual badge style for table and preview display.
     */
    public function badgeStyle(): string
    {
        return match ($this) {
            self::Active => 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;',
            self::OnLeave => 'background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a;',
            self::Resigned => 'background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;',
            self::Terminated => 'background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;',
        };
    }

    /**
     * Key-value options for HTML select dropdowns.
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
     * All string values for validation rules.
     *
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
