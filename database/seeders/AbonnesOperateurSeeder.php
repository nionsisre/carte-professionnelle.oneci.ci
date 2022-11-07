<?php

namespace Database\Seeders;

use App\Models\AbonnesOperateur;
use Illuminate\Database\Seeder;

class AbonnesOperateurSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        AbonnesOperateur::create(['libelle_operateur' => 'Orange CI']);
        AbonnesOperateur::create(['libelle_operateur' => 'MTN CI']);
        AbonnesOperateur::create(['libelle_operateur' => 'Moov Africa']);
    }

}
