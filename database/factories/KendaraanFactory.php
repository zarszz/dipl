<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Kendaraan;
use Illuminate\Database\Eloquent\Factories\Factory;

class KendaraanFactory extends Factory
{
    protected $model = Kendaraan::class;

    public function definition()
    {
        return [
            'title'       => $this->faker->word,
            'description' => $this->faker->sentence,
            'creator_id'  => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
