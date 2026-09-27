<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVolunteerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'gender' => ['nullable', 'string', 'in:Male,Female,Other'],
            'age_group' => ['nullable', 'string', 'in:20+,30+,40+,60+,80+'],
            'address' => ['nullable', 'string', 'max:500'],
            'event_name' => ['nullable', 'string', 'max:255'],
            'experience' => ['nullable', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
