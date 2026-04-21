<?php

namespace Database\Seeders;

use App\Models\ConstructionPlan;
use Illuminate\Database\Seeder;

class ConstructionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic',
                'price_per_sqft' => 1500,
                'features' => ['Standard Foundation', 'Basic Brickwork', 'Standard Windows', 'Single Floor Option', 'Basic Electricals'],
                'is_active' => true,
            ],
            [
                'name' => 'Standard',
                'price_per_sqft' => 2000,
                'features' => ['Reinforced Foundation', 'Quality Finishing', 'Double Glazed Windows', 'Modular Kitchen Basic', 'Premium Paints'],
                'is_active' => true,
            ],
            [
                'name' => 'Premium',
                'price_per_sqft' => 2800,
                'features' => ['Earthquake Resistant', 'Imported Flooring', 'Smart Home Basics', 'False Ceiling', 'Modular Kitchen Pro'],
                'is_active' => true,
            ],
            [
                'name' => 'Luxury',
                'price_per_sqft' => 4500,
                'features' => ['Architectural Design', 'Marble Flooring', 'Central AC Provisions', 'Landscaping', 'Advanced Smart Home'],
                'is_active' => true,
            ],
            [
                'name' => 'Ultra Luxury',
                'price_per_sqft' => 7500,
                'features' => ['Custom Blueprints', 'Private Pool Option', 'Elevator Provision', 'Solar Integration', 'Automated Security'],
                'is_active' => true,
            ],
            [
                'name' => 'Investor Plan',
                'price_per_sqft' => 1200,
                'features' => ['High ROI Focus', 'Rapid Construction', 'Quality for Rental', 'Optimized Materials', 'Systematic Updates'],
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            ConstructionPlan::updateOrCreate(['name' => $plan['name']], $plan);
        }
    }
}
