<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AbonnesNumeroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'abonne_id' => $this->faker->numerify("#"),
            'operateur_id' => $this->faker->randomElement([1, 2, 3]),
            'numero_de_telephone' => $this->faker->randomElement([
                $this->faker->numerify("01 ## ## ## ##"),
                $this->faker->numerify("05 ## ## ## ##"),
                $this->faker->numerify("07 ## ## ## ##")
            ]),
        ];
    }
}
