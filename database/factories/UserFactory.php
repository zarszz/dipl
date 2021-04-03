<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'jenis_kelamin' => $this->faker->randomElement(['pria', 'wanita']),
            'alamat' => $this->faker->words($nbWords = 10, $variableNbWords = true),
            'role_id' => $this->faker->randomElement([1, 2]),
            'email_verified_at' => now(),
            'password' => $this->faker->randomElement(['password'. 'password']),
            'created_at' => $this->faker->dateTimeBetween($startDate='- 1 years', $endDate='now'),
            'remember_token' => Str::random(10),
        ];
    }
}
