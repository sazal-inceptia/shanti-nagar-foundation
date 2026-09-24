<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSalaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $salaryId = $this->route('salary') ? $this->route('salary')->id : $this->id;

        return [
            'salary_slip_number' => ['required', 'string', 'max:50', Rule::unique('salaries', 'salary_slip_number')->ignore($salaryId)],
            'employee_id' => ['required', 'exists:employees,id'],
            'month_year' => ['required', 'string', 'max:50'],
            'basic_amount' => ['required', 'numeric', 'min:0', 'max:999999999.99'],
            'allowance' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'bonus' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'deductions' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'payment_date' => ['required', 'date'],
            'payment_method' => ['required', 'string', 'max:50'],
            'transaction_reference' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'string', Rule::in(['paid', 'pending'])],
            'notes' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'salary_slip_number' => 'salary slip number',
            'employee_id' => 'staff employee',
            'month_year' => 'salary disbursement month',
            'basic_amount' => 'basic salary amount',
            'allowance' => 'allowance',
            'bonus' => 'bonus',
            'deductions' => 'deductions',
            'payment_date' => 'disbursement date',
            'payment_method' => 'payment method',
            'transaction_reference' => 'transaction reference',
            'status' => 'payment status',
        ];
    }
}
