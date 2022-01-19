<?php

namespace Database\Factories;

use App\Models\House;
use Illuminate\Database\Eloquent\Factories\Factory;

class HouseFactory extends Factory
{
    protected $model = House::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(20),
            'description' => $this->faker->realText(),
            'address' => $this->faker->address(),
            'rooms' => rand(3, 15),
            'category_id' => rand(1, 5),
            'price_per_day' => rand(100, 1000) * 10,
            'image' => 'houses/default.png',
        ];
    }
}
