<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'donor_id' => ['nullable', 'exists:donors,id'],
            'new_donor_name' => ['nullable', 'required_without:donor_id', 'string', 'max:255'],
            'new_donor_phone' => ['nullable', 'string', 'max:50'],
            'new_donor_email' => ['nullable', 'email', 'max:255'],
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
