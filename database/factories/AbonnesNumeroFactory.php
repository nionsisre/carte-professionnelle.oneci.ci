<?php

namespace Database\Factories;

use App\Models\Abonne;
use App\Models\AbonnesOperateur;
use App\Models\AbonnesStatut;
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
            'abonne_id' =>  Abonne::inRandomOrder()->first()->id,
            'abonnes_operateur_id' => AbonnesOperateur::inRandomOrder()->first()->id,
            'abonnes_statut_id' => AbonnesStatut::inRandomOrder()->first()->id,
            'numero_de_telephone' => $this->faker->randomElement([
                $this->faker->numerify("01 ## ## ## ##"),
                $this->faker->numerify("05 ## ## ## ##"),
                $this->faker->numerify("07 ## ## ## ##")
            ]),
        ];
    }
}
