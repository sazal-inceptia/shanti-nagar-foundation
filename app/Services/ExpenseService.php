<?php

namespace App\Services;

use App\Enums\ExpenseCategory;
use App\Models\Expense;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExpenseService
{
    /**
     * Get paginated expenses with optional filtering.
     *
     * @param  array<string, mixed>  $filters
     */
    public function getPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Expense::query()->with(['project', 'creator']);

        if (! empty($filters['project_id'])) {
            $query->where('project_id', $filters['project_id']);
        }

        if (! empty($filters['expense_category'])) {
            $query->where('expense_category', $filters['expense_category']);
        }

        if (! empty($filters['payment_method'])) {
            $query->where('payment_method', $filters['payment_method']);
        }

        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('voucher_number', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('recipient_or_vendor', 'like', "%{$search}%")
                    ->orWhere('amount', 'like', "%{$search}%");
            });
        }

        return $query->latest('expense_date')->paginate($perPage);
    }

    /**
     * Store a newly created expense voucher with file upload support.
     *
     * @param  array<string, mixed>  $data
     */
    public function store(array $data): Expense
    {
        return DB::transaction(function () use ($data) {
            if (empty($data['voucher_number'])) {
                $data['voucher_number'] = $this->generateVoucherNumber();
            }

            if (isset($data['receipt_voucher_file']) && $data['receipt_voucher_file'] instanceof UploadedFile) {
                $path = $data['receipt_voucher_file']->store('uploads/expenses', 'public');
                $data['receipt_voucher_file'] = 'storage/'.$path;
            }

            if (empty($data['created_by']) && Auth::check()) {
                $data['created_by'] = Auth::id();
            }

            return Expense::create($data);
        });
    }

    /**
     * Update an existing expense record.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Expense $expense, array $data): Expense
    {
        return DB::transaction(function () use ($expense, $data) {
            if (isset($data['receipt_voucher_file']) && $data['receipt_voucher_file'] instanceof UploadedFile) {
                // Delete old file if present
                if (! empty($expense->receipt_voucher_file)) {
                    $oldPath = str_replace('storage/', '', $expense->receipt_voucher_file);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                $path = $data['receipt_voucher_file']->store('uploads/expenses', 'public');
                $data['receipt_voucher_file'] = 'storage/'.$path;
            }

            $expense->update($data);

            return $expense->fresh();
        });
    }

    /**
     * Delete an expense record.
     */
    public function delete(Expense $expense): bool
    {
        return DB::transaction(function () use ($expense) {
            return (bool) $expense->delete();
        });
    }

    /**
     * Generate next sequential voucher number (e.g., VCH-2026-001).
     */
    public function generateVoucherNumber(): string
    {
        $year = date('Y');
        $prefix = "VCH-{$year}-";

        $lastVoucher = Expense::withTrashed()
            ->where('voucher_number', 'like', "{$prefix}%")
            ->orderByDesc('id')
            ->value('voucher_number');

        if ($lastVoucher) {
            $lastNumber = (int) substr($lastVoucher, strlen($prefix));
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return sprintf('%s%03d', $prefix, $nextNumber);
    }

    /**
     * Get available expense categories.
     *
     * @return array<string, string>
     */
    public function getCategories(): array
    {
        return ExpenseCategory::options();
    }

    /**
     * Get available payment methods.
     *
     * @return array<string, string>
     */
    public function getPaymentMethods(): array
    {
        return [
            'Cash' => 'Cash in Hand',
            'Bank Transfer' => 'Bank Transfer / Electronic',
            'Cheque' => 'Cheque / Pay Order',
            'bKash' => 'bKash Merchant / Personal',
            'Nagad' => 'Nagad Wallet',
            'Rocket' => 'Rocket DBBL',
            'Other' => 'Other / Reimbursement',
        ];
    }
}
