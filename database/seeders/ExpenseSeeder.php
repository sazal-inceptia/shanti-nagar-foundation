<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all()->keyBy('slug');
        $adminUser = User::first();

        $expenses = [
            [
                'voucher_number' => 'VCH-2026-001',
                'project_slug' => 'hospital-equipment-fan-donation-drive',
                'expense_category' => 'Project Procurement',
                'title' => 'Purchase of 50 GFC/BRB Ceiling Fans & Regulators',
                'description' => 'Procured heavy-duty ceiling fans from Nawabpur electronics market including delivery.',
                'amount' => 125000.00,
                'expense_date' => now()->subDays(18),
                'payment_method' => 'Bank Transfer',
                'recipient_or_vendor' => 'Al-Madina Electronics, Nawabpur',
            ],
            [
                'voucher_number' => 'VCH-2026-002',
                'project_slug' => 'hospital-equipment-fan-donation-drive',
                'expense_category' => 'Installation & Labor',
                'title' => 'Electrician Wiring & Installation Charges',
                'description' => 'Fittings, hooks, and wiring in 4 general wards of Dhaka Medical College.',
                'amount' => 17000.00,
                'expense_date' => now()->subDays(16),
                'payment_method' => 'Cash',
                'recipient_or_vendor' => 'Master Electrician Team',
            ],
            [
                'voucher_number' => 'VCH-2026-003',
                'project_slug' => 'emergency-flood-food-packages',
                'expense_category' => 'Relief Goods Purchase',
                'title' => 'Bulk Purchase of Rice, Lentils, Oil & Salt',
                'description' => '500 emergency grocery bags packed for Feni flood victims.',
                'amount' => 240000.00,
                'expense_date' => now()->subMonths(2),
                'payment_method' => 'Cheque',
                'recipient_or_vendor' => 'Karwan Bazar Wholesale Store',
            ],
            [
                'voucher_number' => 'VCH-2026-004',
                'project_slug' => 'emergency-flood-food-packages',
                'expense_category' => 'Transport & Boat Hire',
                'title' => 'Truck Freight to Feni & Rescue Boat Rentals',
                'description' => 'Transportation of relief cargo from Dhaka to Feni bypass and boats for flood relief distribution.',
                'amount' => 52000.00,
                'expense_date' => now()->subMonths(2),
                'payment_method' => 'bKash',
                'recipient_or_vendor' => 'Bengal Transport Agency',
            ],
            [
                'voucher_number' => 'VCH-2026-005',
                'project_slug' => 'deep-tube-well-clean-water-installation',
                'expense_category' => 'Well Drilling & Equipment',
                'title' => '850ft Boring, PVC Pipes & Stainless Pump Head',
                'description' => 'Drilling contractor payment and heavy-duty casting pipe installation in Sunamganj.',
                'amount' => 118000.00,
                'expense_date' => now()->subMonths(1),
                'payment_method' => 'Bank Transfer',
                'recipient_or_vendor' => 'Surma Engineering & Boring',
            ],
            [
                'voucher_number' => 'VCH-2026-006',
                'project_slug' => 'feed-nutritious-meals-poor-children',
                'expense_category' => 'Food & Nutrition',
                'title' => 'Weekly Lunch Meals, Eggs & Fruits Supply',
                'description' => 'Groceries, eggs, bananas, and cooking supplies for 250 rural school children.',
                'amount' => 42000.00,
                'expense_date' => now()->subDays(6),
                'payment_method' => 'Cash',
                'recipient_or_vendor' => 'Gazipur Fresh Food Suppliers',
            ],
            [
                'voucher_number' => 'VCH-2026-007',
                'project_slug' => 'wheelchairs-assistive-devices-disabled',
                'expense_category' => 'Medical Equipment',
                'title' => 'Purchase of 5 Foldable Wheelchairs & Crutches',
                'description' => 'Custom wheelchairs procured for distribution in Mirpur and Shanti Nagar.',
                'amount' => 38000.00,
                'expense_date' => now()->subDays(10),
                'payment_method' => 'Bank Transfer',
                'recipient_or_vendor' => 'MediTech Surgicals, Dhaka',
            ],
            [
                'voucher_number' => 'VCH-2026-008',
                'project_slug' => 'primary-education-scholarships-girls',
                'expense_category' => 'Educational Aid',
                'title' => 'School Bags, Textbooks & Annual Uniforms',
                'description' => 'Educational kit distribution for 80 female students in Mymensingh.',
                'amount' => 52000.00,
                'expense_date' => now()->subDays(9),
                'payment_method' => 'Cheque',
                'recipient_or_vendor' => 'Bangla Bazar Book Syndicate',
            ],
            [
                'voucher_number' => 'VCH-2026-009',
                'project_slug' => 'medical-assistance-surgery-fund',
                'expense_category' => 'Hospital Aid',
                'title' => 'Hospital Surgical Costs & Medication Grants',
                'description' => 'Direct grants for critical cardiac & orthopedic surgery bills.',
                'amount' => 95000.00,
                'expense_date' => now()->subDays(12),
                'payment_method' => 'Bank Transfer',
                'recipient_or_vendor' => 'National Institute of Diseases Account',
            ],
            [
                'voucher_number' => 'VCH-2026-010',
                'project_slug' => 'tree-plantation-environmental-campaign',
                'expense_category' => 'Environmental Campaign',
                'title' => 'Procurement of 5,000 Fruit & Medicinal Saplings',
                'description' => 'Saplings and compost fertilizer delivered for school boundary plantation.',
                'amount' => 48000.00,
                'expense_date' => now()->subMonths(1),
                'payment_method' => 'Cash',
                'recipient_or_vendor' => 'Jamalpur Central Nursery',
            ],
            [
                'voucher_number' => 'VCH-2026-011',
                'project_slug' => 'ramadan-iftar-food-rations',
                'expense_category' => 'Relief Goods Purchase',
                'title' => 'Bulk Ramadan Grocery Rations Packing',
                'description' => '300 grocery gift bags packed and distributed to widow-led households.',
                'amount' => 175000.00,
                'expense_date' => now()->subMonths(4),
                'payment_method' => 'Cheque',
                'recipient_or_vendor' => 'Shanti Nagar General Store',
            ],
            [
                'voucher_number' => 'VCH-2026-012',
                'project_slug' => null,
                'expense_category' => 'Office Utility & Internet',
                'title' => 'Monthly Electricity & Broadband Internet Bill',
                'description' => 'Shanti Nagar central office DESCO electric bill and fiber internet for operations.',
                'amount' => 8500.00,
                'expense_date' => now()->subDays(5),
                'payment_method' => 'bKash',
                'recipient_or_vendor' => 'DESCO & AmberIT',
            ],
        ];

        foreach ($expenses as $item) {
            $projectId = isset($projects[$item['project_slug']]) ? $projects[$item['project_slug']]->id : null;

            Expense::updateOrCreate(
                ['voucher_number' => $item['voucher_number']],
                [
                    'project_id' => $projectId,
                    'expense_category' => $item['expense_category'],
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'amount' => $item['amount'],
                    'expense_date' => $item['expense_date'],
                    'payment_method' => $item['payment_method'],
                    'recipient_or_vendor' => $item['recipient_or_vendor'],
                    'created_by' => $adminUser ? $adminUser->id : null,
                ]
            );
        }
    }
}
