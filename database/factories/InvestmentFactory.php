<?php

namespace Database\Factories;

use App\Models\Investor;
use App\Models\Project;
use App\Models\Investment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Investment>
 */
class InvestmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'investor_id' => Investor::factory(),
            'project_id' => Project::factory(),
            'amount' => $this->faker->randomFloat(2, 10000, 500000),
            'investment_date' => $this->faker->date(),
            'notes' => $this->faker->sentence(),
        ];
    }
}
