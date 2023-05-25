<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
	protected $model = User::class;
    public function definition(): array
    {
        return [
			'document_id' =>$this->faker->numberBetween(),
			'name' => $this->faker->firstName(),
			'last_name' => $this->faker->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => ('123456789'),
			'address' => $this->faker->address()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
