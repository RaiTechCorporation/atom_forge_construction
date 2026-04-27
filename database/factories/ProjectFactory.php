<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company().' Project',
            'client_name' => $this->faker->name(),
            'location' => $this->faker->address(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'total_budget' => $this->faker->randomFloat(2, 100000, 1000000),
            'status' => 'Ongoing',
        ];
    }
}
