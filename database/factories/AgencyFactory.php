<?php

namespace Database\Factories;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Agency>
 */
class AgencyFactory extends Factory
{
    protected $model = \App\Models\Agency::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'director' => fake()->name(),
            'account' => fake()->userName(),
            'license_date' => fake()->date(),
            'commission' => fake()->randomFloat(2, 5, 20),
        ];
    }
}
