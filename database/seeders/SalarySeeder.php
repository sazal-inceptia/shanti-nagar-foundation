<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            // Seed last 2 months' salary history
            $months = [
                [
                    'slip_suffix' => '01',
                    'month_year' => 'August 2026',
                    'date' => '2026-08-31',
                ],
                [
                    'slip_suffix' => '02',
                    'month_year' => 'September 2026',
                    'date' => '2026-09-24',
                ],
            ];

            foreach ($months as $m) {
                $slipNumber = 'PAY-' . $employee->employee_id . '-' . $m['slip_suffix'];
                $basic = $employee->base_salary;
                $allowance = 2000.00;
                $bonus = 0.00;
                $deductions = 0.00;
                $netPaid = $basic + $allowance + $bonus - $deductions;

                Salary::updateOrCreate(
                    ['salary_slip_number' => $slipNumber],
                    [
                        'employee_id' => $employee->id,
                        'month_year' => $m['month_year'],
                        'basic_amount' => $basic,
                        'allowance' => $allowance,
                        'bonus' => $bonus,
                        'deductions' => $deductions,
                        'net_paid_amount' => $netPaid,
                        'payment_date' => $m['date'],
                        'payment_method' => 'bank_transfer',
                        'transaction_reference' => 'SAL-TXN-' . rand(100000, 999999),
                        'status' => 'paid',
                        'notes' => 'Monthly staff salary disbursed via official banking channel.',
                    ]
                );
            }
        }
    }
}
