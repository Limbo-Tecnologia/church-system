<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Church>
 */
class ChurchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'document_number' => $this->faker->unique()->numerify('##.###.###/####-##'),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'geolocation' => $this->faker->latitude . ',' . $this->faker->longitude,
            'foundation_date' => $this->faker->date(),
        ];
    }
}
