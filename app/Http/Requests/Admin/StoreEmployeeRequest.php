<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? $this->boolean('is_active') : true,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'employee_id' => ['nullable', 'string', 'max:50', 'unique:employees,employee_id'],
            'name' => ['required', 'string', 'max:255'],
            'name_bn' => ['nullable', 'string', 'max:255'],
            'designation_id' => ['nullable', 'integer', 'exists:designations,id'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'nid_number' => ['nullable', 'string', 'max:50'],
            'present_address' => ['nullable', 'string'],
            'permanent_address' => ['nullable', 'string'],
            'joining_date' => ['required', 'date'],
            'base_salary' => ['required', 'numeric', 'min:0', 'max:999999999.99'],
            'is_active' => ['nullable', 'boolean'],
            'photo' => ['nullable', 'file', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
            'is_highlight' => ['nullable', 'boolean'],
            'speech' => ['nullable', 'string'],
            'speech_tag' => ['nullable', 'string', 'max:150'],
            'bio' => ['nullable', 'string'],
            'bio_bn' => ['nullable', 'string'],
            'signature_text' => ['nullable', 'string', 'max:150'],
            'signature_title' => ['nullable', 'string', 'max:150'],
            'badge_title' => ['nullable', 'string', 'max:100'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'twitter_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'order_index' => ['nullable', 'integer', 'min:0'],
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
            'designation_id' => 'designation',
            'phone' => 'phone number',
            'email' => 'email address',
            'nid_number' => 'National ID (NID)',
            'joining_date' => 'joining date',
            'base_salary' => 'basic salary (BDT)',
            'is_active' => 'active status',
            'photo' => 'profile photo',
        ];
    }
}
