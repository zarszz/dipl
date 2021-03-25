<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Factories\Factory;

class RuanganFactory extends Factory
{
    protected $model = Ruangan::class;

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
