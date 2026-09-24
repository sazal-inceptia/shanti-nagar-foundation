<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDonationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'donor_id' => ['nullable', 'exists:donors,id'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'amount' => ['required', 'numeric', 'min:1'],
            'currency' => ['required', 'string', 'max:10'],
            'payment_method' => ['required', 'string', 'max:50'],
            'transaction_id' => ['nullable', 'string', 'max:100'],
            'donation_date' => ['required', 'date'],
            'purpose' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:completed,pending,cancelled'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
