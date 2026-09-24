<?php

namespace App\Http\Requests\Admin;

use App\Enums\EmploymentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
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
        return [
            'employee_id' => ['nullable', 'string', 'max:50', 'unique:employees,employee_id'],
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'nid_number' => ['nullable', 'string', 'max:50'],
            'present_address' => ['nullable', 'string'],
            'permanent_address' => ['nullable', 'string'],
            'joining_date' => ['required', 'date'],
            'base_salary' => ['required', 'numeric', 'min:0', 'max:999999999.99'],
            'employment_status' => ['required', 'string', Rule::in(EmploymentStatus::values())],
            'photo' => ['nullable', 'file', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'employee_id' => 'employee ID',
            'name' => 'full name',
            'designation' => 'designation / role',
            'department' => 'department',
            'phone' => 'phone number',
            'email' => 'email address',
            'nid_number' => 'National ID (NID)',
            'joining_date' => 'joining date',
            'base_salary' => 'basic salary (BDT)',
            'employment_status' => 'employment status',
            'photo' => 'profile photo',
        ];
    }
}
