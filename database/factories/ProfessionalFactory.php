<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professional>
 */
class ProfessionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->name(),
            'email'         => $this->faker->unique()->safeEmail(),
            'phone'         => $this->faker->numerify('9#########'), 
            'speciality_id' => $this->faker->numberBetween(1, 10),   
            'is_active'     => $this->faker->boolean(90),
        ];
    }
}
