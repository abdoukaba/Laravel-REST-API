<?php

namespace Database\Factories;

use App\Models\Sneaker;
use Illuminate\Database\Eloquent\Factories\Factory;

class SneakerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sneaker::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
     
    return [
        'sneaker_name' => $this->faker->name,
        'user_id' =>  $this->faker->numberBetween($min = 1, $max = 100),
        'hyper_level' => $this->faker->numberBetween($min = 1, $max = 9),
        'price' => $this->faker->numberBetween($min = 100, $max = 600),
        'release_date' => $this->faker->date,
       
      ];
  
 }
}
