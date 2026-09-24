<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    public function run(): void
    {
        $donors = Donor::all()->keyBy('name');
        $projects = Project::all()->keyBy('slug');

        $donations = [
            [
                'receipt_number' => 'REC-2026-001',
                'donor_name' => 'Alhaj Noor Mohammad',
                'project_slug' => 'hospital-equipment-fan-donation-drive',
                'amount' => 50000.00,
                'currency' => 'BDT',
                'payment_method' => 'Bank Transfer',
                'transaction_id' => 'TXN-EBL-998811',
                'donation_date' => now()->subDays(20),
                'purpose' => 'Hospital Ceiling Fan Supply',
                'status' => 'completed',
                'notes' => 'Donation for 20 ceiling fans in general ward.',
            ],
            [
                'receipt_number' => 'REC-2026-002',
                'donor_name' => 'Santi Nagar Business Welfare Trust',
                'project_slug' => 'emergency-flood-food-packages',
                'amount' => 150000.00,
                'currency' => 'BDT',
                'payment_method' => 'Cheque',
                'transaction_id' => 'CHQ-DBBL-445566',
                'donation_date' => now()->subMonths(2),
                'purpose' => 'Emergency Flood Relief Feni',
                'status' => 'completed',
                'notes' => 'Corporate grant for flood food packages.',
            ],
            [
                'receipt_number' => 'REC-2026-003',
                'donor_name' => 'Engr. Mahbubur Rahman',
                'project_slug' => 'deep-tube-well-clean-water-installation',
                'amount' => 80000.00,
                'currency' => 'BDT',
                'payment_method' => 'bKash',
                'transaction_id' => 'BK-8899AA77',
                'donation_date' => now()->subMonths(1),
                'purpose' => 'Safe Drinking Water Well',
                'status' => 'completed',
                'notes' => 'Sadaqah Jariyah on behalf of parents.',
            ],
            [
                'receipt_number' => 'REC-2026-004',
                'donor_name' => 'Dr. Farhana Yasmin',
                'project_slug' => 'free-medical-camp-medicine-supply',
                'amount' => 35000.00,
                'currency' => 'BDT',
                'payment_method' => 'Nagad',
                'transaction_id' => 'NGD-55667788',
                'donation_date' => now()->subDays(15),
                'purpose' => 'Essential Medicines Supply',
                'status' => 'completed',
                'notes' => 'For free prescription distribution at Friday Medical Camp.',
            ],
            [
                'receipt_number' => 'REC-2026-005',
                'donor_name' => 'Tariqul Islam (Expatriate, UK)',
                'project_slug' => 'nutritious-food-education-kit-orphans',
                'amount' => 60000.00,
                'currency' => 'BDT',
                'payment_method' => 'Remittance (Bank)',
                'transaction_id' => 'REMIT-SCB-120034',
                'donation_date' => now()->subDays(10),
                'purpose' => 'Orphan Education Stipend',
                'status' => 'completed',
                'notes' => 'Zakat remittance for stationery and food.',
            ],
            [
                'receipt_number' => 'REC-2026-006',
                'donor_name' => 'Well-wisher (Anonymous)',
                'project_slug' => 'warm-blankets-winter-clothes-relief',
                'amount' => 45000.00,
                'currency' => 'BDT',
                'payment_method' => 'Cash',
                'transaction_id' => 'CASH-REC-006',
                'donation_date' => now()->subDays(5),
                'purpose' => 'Winter Blanket Relief',
                'status' => 'completed',
                'notes' => 'Direct cash donation to office counter.',
            ],
        ];

        foreach ($donations as $item) {
            $donorId = isset($donors[$item['donor_name']]) ? $donors[$item['donor_name']]->id : null;
            $projectId = isset($projects[$item['project_slug']]) ? $projects[$item['project_slug']]->id : null;

            Donation::updateOrCreate(
                ['receipt_number' => $item['receipt_number']],
                [
                    'donor_id' => $donorId,
                    'project_id' => $projectId,
                    'amount' => $item['amount'],
                    'currency' => $item['currency'],
                    'payment_method' => $item['payment_method'],
                    'transaction_id' => $item['transaction_id'],
                    'donation_date' => $item['donation_date'],
                    'purpose' => $item['purpose'],
                    'status' => $item['status'],
                    'notes' => $item['notes'],
                ]
            );
        }
    }
}
