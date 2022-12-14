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
        $msisdn = $this->faker->randomElement([
            $this->faker->numerify("07########"),
            $this->faker->numerify("05########"),
            $this->faker->numerify("01########")
        ]);
        switch (substr($msisdn, 0, 2)) {
            case '07':
                $telco_id = 1;
                break;
            case '05':
                $telco_id = 2;
                break;
            case '01':
                $telco_id = 3;
                break;
        }
        return [
            'abonne_id' =>  Abonne::inRandomOrder()->first()->id,
            'abonnes_operateur_id' => $telco_id,
            'abonnes_statut_id' => AbonnesStatut::inRandomOrder()->first()->id,
            /*'numero_de_telephone' => $this->faker->randomElement([
                $this->faker->numerify("01 ## ## ## ##"),
                $this->faker->numerify("05 ## ## ## ##"),
                $this->faker->numerify("07 ## ## ## ##")
            ]),*/
            'numero_de_telephone' => $msisdn,
        ];
    }
}
