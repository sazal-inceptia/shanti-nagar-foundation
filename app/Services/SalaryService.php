<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SalaryService
{
    /**
     * Get paginated salary disbursement records.
     *
     * @param  array<string, mixed>  $filters
     */
    public function getPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Salary::query()->with('employee');

        if (! empty($filters['employee_id'])) {
            $query->where('employee_id', $filters['employee_id']);
        }

        if (! empty($filters['month_year'])) {
            $query->where('month_year', $filters['month_year']);
        }

        if (! empty($filters['payment_method'])) {
            $query->where('payment_method', $filters['payment_method']);
        }

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest('payment_date')->paginate($perPage);
    }

    /**
     * Store a newly disbursed salary record.
     *
     * @param  array<string, mixed>  $data
     */
    public function store(array $data): Salary
    {
        return DB::transaction(function () use ($data) {
            $basic = (float) ($data['basic_amount'] ?? 0);
            $allowance = (float) ($data['allowance'] ?? 0);
            $bonus = (float) ($data['bonus'] ?? 0);
            $deductions = (float) ($data['deductions'] ?? 0);

            $data['net_paid_amount'] = $basic + $allowance + $bonus - $deductions;

            if (empty($data['salary_slip_number'])) {
                $employee = Employee::findOrFail($data['employee_id']);
                $data['salary_slip_number'] = $this->generateSlipNumber($employee);
            }

            return Salary::create($data);
        });
    }

    /**
     * Update an existing salary record.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Salary $salary, array $data): Salary
    {
        return DB::transaction(function () use ($salary, $data) {
            $basic = (float) ($data['basic_amount'] ?? $salary->basic_amount);
            $allowance = (float) ($data['allowance'] ?? $salary->allowance);
            $bonus = (float) ($data['bonus'] ?? $salary->bonus);
            $deductions = (float) ($data['deductions'] ?? $salary->deductions);

            $data['net_paid_amount'] = $basic + $allowance + $bonus - $deductions;

            $salary->update($data);

            return $salary->fresh();
        });
    }

    /**
     * Delete a salary record.
     */
    public function delete(Salary $salary): bool
    {
        return DB::transaction(function () use ($salary) {
            return (bool) $salary->delete();
        });
    }

    /**
     * Generate next sequential salary slip number (e.g. PAY-EMP-101-03).
     */
    public function generateSlipNumber(Employee $employee): string
    {
        $count = $employee->salaries()->count() + 1;

        return sprintf('PAY-%s-%02d', $employee->employee_id, $count);
    }

    /**
     * Get available payment methods.
     *
     * @return array<string, string>
     */
    public function getPaymentMethods(): array
    {
        return [
            'bank_transfer' => 'Bank Transfer / Direct Deposit',
            'cash' => 'Cash Disbursement',
            'cheque' => 'Bank Cheque / Pay Order',
            'bkash' => 'bKash Corporate Payroll',
            'nagad' => 'Nagad Wallet',
            'rocket' => 'Rocket DBBL',
        ];
    }
}
