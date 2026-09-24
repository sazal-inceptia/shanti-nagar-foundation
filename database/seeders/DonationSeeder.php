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
            [
                'receipt_number' => 'REC-2026-007',
                'donor_name' => 'Santi Nagar Business Welfare Trust',
                'project_slug' => 'feed-nutritious-meals-poor-children',
                'amount' => 50000.00,
                'currency' => 'BDT',
                'payment_method' => 'Bank Transfer',
                'transaction_id' => 'TXN-EBL-332211',
                'donation_date' => now()->subDays(8),
                'purpose' => 'Nutritious Meals for Rural Children',
                'status' => 'completed',
                'notes' => 'Sponsorship for 200 school student lunch meals.',
            ],
            [
                'receipt_number' => 'REC-2026-008',
                'donor_name' => 'Dr. Farhana Yasmin',
                'project_slug' => 'wheelchairs-assistive-devices-disabled',
                'amount' => 35000.00,
                'currency' => 'BDT',
                'payment_method' => 'bKash',
                'transaction_id' => 'BK-55443322',
                'donation_date' => now()->subDays(12),
                'purpose' => 'Wheelchairs for Disabled Persons',
                'status' => 'completed',
                'notes' => 'Donation for 5 heavy-duty wheelchairs.',
            ],
            [
                'receipt_number' => 'REC-2026-009',
                'donor_name' => 'Tariqul Islam (Expatriate, UK)',
                'project_slug' => 'primary-education-scholarships-girls',
                'amount' => 65000.00,
                'currency' => 'BDT',
                'payment_method' => 'Remittance (Bank)',
                'transaction_id' => 'REMIT-HSBC-887766',
                'donation_date' => now()->subDays(14),
                'purpose' => 'Female Student Scholarships',
                'status' => 'completed',
                'notes' => 'Annual educational stipend and textbooks support.',
            ],
            [
                'receipt_number' => 'REC-2026-010',
                'donor_name' => 'Alhaj Noor Mohammad',
                'project_slug' => 'medical-assistance-surgery-fund',
                'amount' => 110000.00,
                'currency' => 'BDT',
                'payment_method' => 'Cheque',
                'transaction_id' => 'CHQ-IBBL-990011',
                'donation_date' => now()->subDays(22),
                'purpose' => 'Emergency Hospital Surgery Fund',
                'status' => 'completed',
                'notes' => 'Direct assistance for ICU and cardiac surgery patients.',
            ],
            [
                'receipt_number' => 'REC-2026-011',
                'donor_name' => 'Engr. Mahbubur Rahman',
                'project_slug' => 'tree-plantation-environmental-campaign',
                'amount' => 50000.00,
                'currency' => 'BDT',
                'payment_method' => 'bKash',
                'transaction_id' => 'BK-11223344',
                'donation_date' => now()->subMonths(2),
                'purpose' => 'Tree Plantation Drive',
                'status' => 'completed',
                'notes' => 'Sponsorship for 1,000 fruit saplings.',
            ],
            [
                'receipt_number' => 'REC-2026-012',
                'donor_name' => 'Well-wisher (Anonymous)',
                'project_slug' => 'ramadan-iftar-food-rations',
                'amount' => 175000.00,
                'currency' => 'BDT',
                'payment_method' => 'Cash',
                'transaction_id' => 'CASH-REC-012',
                'donation_date' => now()->subMonths(5),
                'purpose' => 'Ramadan Iftar & Grocery Rations',
                'status' => 'completed',
                'notes' => 'Full sponsorship for 250 Ramadan food baskets.',
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
