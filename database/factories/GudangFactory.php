<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Gudang;
use Illuminate\Database\Eloquent\Factories\Factory;

class GudangFactory extends Factory
{
    protected $model = Gudang::class;

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
