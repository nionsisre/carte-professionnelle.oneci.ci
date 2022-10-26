<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AbonnesStatutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code_statut' => Str::random(3),
            'libelle_statut' => $this->faker->colorName(),
        ];
    }
}
