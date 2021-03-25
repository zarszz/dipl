<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ticketing;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketingFactory extends Factory
{
    protected $model = Ticketing::class;

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
