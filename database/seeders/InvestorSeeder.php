<?php

namespace Database\Seeders;

use App\Models\Investor;
use App\Models\Investment;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvestorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 3 projects first
        $projects = Project::factory(3)->create();

        // Get all investors (including the test one created in DatabaseSeeder)
        Investor::all()->each(function ($investor) use ($projects) {
            // Create 2 investments for each investor
            foreach ($projects->random(2) as $project) {
                Investment::factory()->create([
                    'investor_id' => $investor->id,
                    'project_id' => $project->id,
                ]);
            }
        });

        // Create 3 more random investors with their own investments
        Investment::factory(6)->create();
    }
}
