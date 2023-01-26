<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RelawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kelamin' => $this->faker->randomElement($array = array('PRIA', 'WANITA')),
            'phone' => '08' . $this->faker->numberBetween(1234567890, 9876543210),
        ];
    }
}
