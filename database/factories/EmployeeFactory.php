<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\FoodPreference;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $phoneNumbers = [
            fake()->phoneNumber(),
            fake()->phoneNumber(),
            fake()->phoneNumber(),
        ];

        return [
            'company_id' => Company::factory(),
            'food_preference_id' => FoodPreference::factory(),
            'email' => fake()->email(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'phone_numbers' => json_encode($phoneNumbers),
        ];
    }
}
