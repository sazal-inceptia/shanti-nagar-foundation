<?php

namespace App\Services;

use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Support\Facades\DB;

class DonationService
{
    /**
     * Get available payment methods.
     */
    public function getPaymentMethods(): array
    {
        return [
            'Cash' => 'Cash (Office Counter)',
            'bKash' => 'bKash (Merchant / Personal)',
            'Nagad' => 'Nagad',
            'Rocket' => 'Rocket',
            'Bank Transfer' => 'Bank Transfer / Wire',
            'Cheque' => 'Cheque / Pay Order',
            'Remittance (Bank)' => 'Expatriate Foreign Remittance',
        ];
    }

    /**
     * Get donation statuses.
     */
    public function getStatuses(): array
    {
        return [
            'completed' => 'Completed (Received)',
            'pending' => 'Pending (Verification)',
            'cancelled' => 'Cancelled / Bounced',
        ];
    }

    /**
     * Generate unique sequential receipt number: REC-YYYY-001
     */
    public function generateReceiptNumber(): string
    {
        $year = date('Y');
        $prefix = "REC-{$year}-";

        $lastDonation = Donation::where('receipt_number', 'like', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->first();

        if (! $lastDonation) {
            return "{$prefix}001";
        }

        $lastNumber = (int) str_replace($prefix, '', $lastDonation->receipt_number);
        $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        return "{$prefix}{$nextNumber}";
    }

    /**
     * Store a new donation record, creating new donor on the fly if needed.
     */
    public function store(array $data): Donation
    {
        return DB::transaction(function () use ($data) {
            // Check if user requested to create new donor on the fly
            if (empty($data['donor_id']) && ! empty($data['new_donor_name'])) {
                $donor = Donor::create([
                    'name' => $data['new_donor_name'],
                    'phone' => $data['new_donor_phone'] ?? null,
                    'email' => $data['new_donor_email'] ?? null,
                    'donor_type' => 'individual',
                    'is_anonymous' => false,
                ]);
                $data['donor_id'] = $donor->id;
            }

            unset($data['new_donor_name'], $data['new_donor_phone'], $data['new_donor_email']);

            if (empty($data['receipt_number'])) {
                $data['receipt_number'] = $this->generateReceiptNumber();
            }

            return Donation::create($data);
        });
    }

    /**
     * Update an existing donation.
     */
    public function update(Donation $donation, array $data): Donation
    {
        return DB::transaction(function () use ($donation, $data) {
            $donation->update($data);

            return $donation;
        });
    }

    /**
     * Delete donation.
     */
    public function delete(Donation $donation): bool
    {
        return DB::transaction(function () use ($donation) {
            return (bool) $donation->delete();
        });
    }
}
