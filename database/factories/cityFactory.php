<?php

namespace Database\Factories;

use App\Models\country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class cityFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'population' => $this->faker->numberBetween(10, 10000000),
            'area' => $this->faker->numberBetween(10, 10000000).$this->faker->randomElement(['km2', 'm2']),
            'postal_code' => $this->faker->randomLetter().
                             $this->faker->randomLetter().
                             '-'.$this->faker->numberBetween(10000, 99999),
            'country_id' => country::all()->random()->id
        ];
    }
}
