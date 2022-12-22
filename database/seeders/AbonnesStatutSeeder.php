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
            'code_statut' => 'NNV',
            'libelle_statut' => 'Numéro non-vérifié',
            'icone' => 'phone-slash',
        ]);
        AbonnesStatut::create([
            'code_statut' => 'DAA',
            'libelle_statut' => 'Document justificatif en attente d\'approbation',
            'icone' => 'hourglass-half',
        ]);
        AbonnesStatut::create([
            'code_statut' => 'NUI',
            'libelle_statut' => 'Numéro identifié',
            'icone' => 'double-check',
        ]);
        AbonnesStatut::create([
            'code_statut' => 'IDR',
            'libelle_statut' => 'Identification refusée',
            'icone' => 'exclamation-circle',
        ]);
    }
}
