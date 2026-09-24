<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                'employee_id' => 'EMP-101',
                'name' => 'Rafiqul Islam',
                'designation' => 'Field Project Coordinator',
                'department' => 'Operations & Relief',
                'phone' => '+8801712998877',
                'email' => 'rafiq.field@shantinagarfoundation.org',
                'nid_number' => '19882692550001234',
                'present_address' => 'House 14, Road 3, Shanti Nagar, Dhaka',
                'permanent_address' => 'Vill: Joypur, P.S: Nabinagar, Brahmanbaria',
                'joining_date' => '2023-01-15',
                'base_salary' => 35000.00,
                'employment_status' => 'active',
                'photo' => 'assets/images/team/team-1.jpg',
            ],
            [
                'employee_id' => 'EMP-102',
                'name' => 'Fatema Begum',
                'designation' => 'Accounts & Documentation Officer',
                'department' => 'Finance & Accounts',
                'phone' => '+8801815667788',
                'email' => 'fatema.acc@shantinagarfoundation.org',
                'nid_number' => '19922692550005678',
                'present_address' => 'Malibagh Chowdhury Para, Dhaka',
                'permanent_address' => 'Vill: Chandpur Sadar, Chandpur',
                'joining_date' => '2023-06-01',
                'base_salary' => 30000.00,
                'employment_status' => 'active',
                'photo' => 'assets/images/team/team-2.jpg',
            ],
            [
                'employee_id' => 'EMP-103',
                'name' => 'Kamrul Hasan',
                'designation' => 'Volunteer Supervisor & Logistics Support',
                'department' => 'Volunteer Management',
                'phone' => '+8801914332211',
                'email' => 'kamrul.volunteer@shantinagarfoundation.org',
                'nid_number' => '19952692550009999',
                'present_address' => 'Santi Nagar Bazaar Lane, Dhaka',
                'permanent_address' => 'Vill: Shibpur, Narsingdi',
                'joining_date' => '2024-02-10',
                'base_salary' => 22000.00,
                'employment_status' => 'active',
                'photo' => 'assets/images/team/team-3.jpg',
            ],
            [
                'employee_id' => 'EMP-104',
                'name' => 'Abdul Kader',
                'designation' => 'Office Caretaker & Logistics Assistant',
                'department' => 'Administration',
                'phone' => '+8801611009988',
                'email' => null,
                'nid_number' => '19792692550007777',
                'present_address' => 'Shanti Nagar Office Staff Room, Dhaka',
                'permanent_address' => 'Vill: Char Fasson, Bhola',
                'joining_date' => '2022-03-01',
                'base_salary' => 16000.00,
                'employment_status' => 'active',
                'photo' => 'assets/images/team/team-4.jpg',
            ],
        ];

        foreach ($employees as $employeeData) {
            Employee::updateOrCreate(
                ['employee_id' => $employeeData['employee_id']],
                $employeeData
            );
        }
    }
}
