<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class countryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'population' => $this->faker->numberBetween(10, 10000000),
            'area' => $this->faker->numberBetween(10, 10000000).'km2',
            'phone_code' => '+'.$this->faker->numberBetween(1, 999)
        ];
    }
}
