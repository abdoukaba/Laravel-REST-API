<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //        'name' => $this->faker->name,
        'user_id'    => $this->faker->numberBetween($min = 1, $max = 100),
        'sneaker_id' => $this->faker->numberBetween($min = 1, $max = 100),
        'rating' => $this->faker->numberBetween($min = 1, $max = 5),
        ];
    }
}
