<?php

namespace App\Http\Requests\Admin;

use App\Enums\DonorType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreDonorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'donor_type' => ['required', new Enum(DonorType::class)],
            'is_anonymous' => ['nullable', 'boolean'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
