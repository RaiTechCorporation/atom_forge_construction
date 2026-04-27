<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Expense;
use App\Models\Investor;
use App\Models\Labour;
use App\Models\Payout;
use App\Models\Project;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AppDataSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        if ($projects->isEmpty()) {
            return;
        }

        // Create some Vendors
        $vendors = [
            ['name' => 'Cement Co.', 'phone' => '9876543211', 'email' => 'cement@example.com', 'contact_person' => 'Mr. Cement'],
            ['name' => 'Steel Hub', 'phone' => '9876543212', 'email' => 'steel@example.com', 'contact_person' => 'Mr. Steel'],
            ['name' => 'Electric Solutions', 'phone' => '9876543213', 'email' => 'electric@example.com', 'contact_person' => 'Mr. Electric'],
        ];

        foreach ($vendors as $v) {
            Vendor::firstOrCreate(['email' => $v['email']], $v);
        }
        $vendorList = Vendor::all();

        // Create Labours
        $labours = [
            [
                'name' => 'Rajesh Kumar',
                'father_name' => 'Ram Kumar',
                'phone' => '9000010001',
                'work_type' => 'Mason',
                'skill_level' => 'Skilled',
                'wage_rate' => 800,
                'wage_type' => 'Daily',
                'joining_date' => '2026-01-01',
                'status' => 'active',
            ],
            [
                'name' => 'Suresh Singh',
                'father_name' => 'Dharam Singh',
                'phone' => '9000010002',
                'work_type' => 'Labourer',
                'skill_level' => 'Unskilled',
                'wage_rate' => 500,
                'wage_type' => 'Daily',
                'joining_date' => '2026-01-05',
                'status' => 'active',
            ],
            [
                'name' => 'Amit Sharma',
                'father_name' => 'OP Sharma',
                'phone' => '9000010003',
                'work_type' => 'Electrician',
                'skill_level' => 'Skilled',
                'wage_rate' => 1000,
                'wage_type' => 'Daily',
                'joining_date' => '2026-02-10',
                'status' => 'active',
            ],
        ];

        foreach ($labours as $l) {
            $l['project_id'] = $projects->random()->id;
            Labour::firstOrCreate(['phone' => $l['phone']], $l);
        }
        $labourList = Labour::all();

        // Attendance & Payments (for the last 30 days)
        $admin = User::where('role', 'super_admin')->first();
        
        foreach ($labourList as $labour) {
            for ($i = 0; $i < 30; $i++) {
                $date = Carbon::now()->subDays($i);
                if ($date->isWeekend()) continue;

                Attendance::updateOrCreate(
                    ['labour_id' => $labour->id, 'date' => $date->toDateString()],
                    [
                        'project_id' => $labour->project_id,
                        'status' => 'present',
                        'shift' => rand(0, 1) ? '1st Shift' : '2nd Shift',
                        'overtime_hours' => rand(0, 2),
                        'payment_amount' => $i % 7 == 0 ? $labour->wage_rate * 6 : 0, // Weekly payment
                        'remark' => 'Automated seeding',
                    ]
                );
            }
        }

        // Expenses (Payments to vendors)
        foreach ($projects as $project) {
            for ($i = 0; $i < 5; $i++) {
                Expense::create([
                    'project_id' => $project->id,
                    'user_id' => $admin->id,
                    'date' => Carbon::now()->subDays(rand(1, 60))->toDateString(),
                    'category' => 'material',
                    'description' => 'Purchase of materials for ' . $project->name,
                    'amount' => rand(5000, 50000),
                    'vendor_id' => $vendorList->random()->id,
                    'payment_mode' => 'bank',
                ]);
            }
        }

        // Payouts (Investor Payments)
        $investors = Investor::all();
        foreach ($investors as $investor) {
            $investments = $investor->investments()->where('status', 'approved')->get();
            foreach ($investments as $investment) {
                Payout::create([
                    'investor_id' => $investor->id,
                    'project_id' => $investment->project_id,
                    'created_by' => $admin->id,
                    'amount_paid' => $investment->investment_amount * 0.05, // 5% return payout
                    'payment_date' => Carbon::now()->subDays(rand(1, 30))->toDateString(),
                    'payment_mode' => 'Online',
                    'remarks' => 'Monthly profit share',
                    'status' => 'approved',
                ]);
            }
        }
    }
}
