<?php

namespace App\Enums;

enum ExpenseCategory: string
{
    case ProjectProcurement = 'Project Procurement';
    case ReliefGoodsPurchase = 'Relief Goods Purchase';
    case InstallationLabor = 'Installation & Labor';
    case TransportLogistics = 'Transport & Logistics';
    case WellDrillingEquipment = 'Well Drilling & Equipment';
    case FoodNutrition = 'Food & Nutrition';
    case MedicalHospitalAid = 'Medical & Hospital Aid';
    case EducationalAid = 'Educational Aid';
    case EnvironmentalCampaign = 'Environmental Campaign';
    case OfficeUtilityRent = 'Office Utility & Rent';
    case Miscellaneous = 'Miscellaneous / Other';

    /**
     * Human-friendly label for display.
     */
    public function label(): string
    {
        return $this->value;
    }

    /**
     * Visual badge style for table and preview display.
     */
    public function badgeStyle(): string
    {
        return match ($this) {
            self::ProjectProcurement => 'background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;',
            self::ReliefGoodsPurchase => 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;',
            self::InstallationLabor => 'background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a;',
            self::TransportLogistics => 'background-color: #f5f3ff; color: #6d28d9; border: 1px solid #ddd6fe;',
            self::WellDrillingEquipment => 'background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd;',
            self::FoodNutrition => 'background-color: #fff7ed; color: #c2410c; border: 1px solid #ffedd5;',
            self::MedicalHospitalAid => 'background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca;',
            self::EducationalAid => 'background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0;',
            self::EnvironmentalCampaign => 'background-color: #ecfeff; color: #0e7490; border: 1px solid #a5f3fc;',
            self::OfficeUtilityRent => 'background-color: #f8fafc; color: #475569; border: 1px solid #cbd5e1;',
            self::Miscellaneous => 'background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1;',
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
