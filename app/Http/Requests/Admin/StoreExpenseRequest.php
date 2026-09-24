<?php

namespace App\Http\Requests\Admin;

use App\Enums\ExpenseCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExpenseRequest extends FormRequest
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
            'voucher_number' => ['nullable', 'string', 'max:50', 'unique:expenses,voucher_number'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'expense_category' => ['required', 'string', Rule::in(ExpenseCategory::values())],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'amount' => ['required', 'numeric', 'min:0.01', 'max:999999999.99'],
            'expense_date' => ['required', 'date'],
            'payment_method' => ['required', 'string', 'max:50'],
            'recipient_or_vendor' => ['nullable', 'string', 'max:255'],
            'receipt_voucher_file' => ['nullable', 'file', 'mimes:jpeg,jpg,png,pdf,webp', 'max:5120'], // 5MB max
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'voucher_number' => 'voucher number',
            'project_id' => 'project / cause',
            'expense_category' => 'expense category',
            'title' => 'expense title / description',
            'amount' => 'expense amount',
            'expense_date' => 'date of expenditure',
            'payment_method' => 'payment mode',
            'recipient_or_vendor' => 'vendor / recipient name',
            'receipt_voucher_file' => 'receipt / invoice attachment',
        ];
    }
}
