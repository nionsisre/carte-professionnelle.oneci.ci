<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AbonneFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'numero_dossier' => $this->faker->unique()->numerify('##########'),
            'nom' => $this->faker->lastName(),
            'nom_epouse' => "",
            'prenoms' => $this->faker->firstName(),
            'date_de_naissance' => $this->faker->dateTimeBetween('-90 years', '-10 years')->format('Y-m-d'),
            /*'date_de_naissance' => date('Y-m-d', time()),*/
            'lieu_de_naissance' => $this->faker->streetName(),
            'genre' => $this->faker->randomElement(['M', 'F']),
            'domicile' => $this->faker->streetName(),
            'profession' => $this->faker->jobTitle(),
            'nationalite' => 'Ivoirienne',
            'email' => $this->faker->unique()->safeEmail(),
            'abonnes_type_piece_id' => $this->faker->randomElement([1, 2, 3]),
            'document_justificatif' => $this->faker->unique()->numerify('##########'),
            'date_enregistrement' => $this->faker->date(),

        ];
    }

}
