<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AbonnesTypePieceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code_type_piece' => Str::random(3),
            'libelle_piece' => $this->faker->colorName()
        ];
    }
}
