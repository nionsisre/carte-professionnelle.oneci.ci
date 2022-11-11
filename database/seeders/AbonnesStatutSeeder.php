<?php

namespace Database\Seeders;

use App\Models\AbonnesStatut;
use Illuminate\Database\Seeder;

class AbonnesStatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AbonnesStatut::create([
            'code_statut' => 'IAT',
            'libelle_statut' => 'Identification en attente de traitement',
            'icone' => 'hourglass-half',
        ]);
        AbonnesStatut::create([
            'code_statut' => 'IDV',
            'libelle_statut' => 'Identification validée',
            'icone' => 'check',
        ]);
        AbonnesStatut::create([
            'code_statut' => 'IDR',
            'libelle_statut' => 'Identification refusée',
            'icone' => 'exclamation-circle',
        ]);
    }
}
