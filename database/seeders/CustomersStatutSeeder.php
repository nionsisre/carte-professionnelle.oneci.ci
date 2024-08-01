<?php

namespace Database\Seeders;

use App\Models\CustomersStatut;
use Illuminate\Database\Seeder;

class CustomersStatutSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomersStatut::create([
            'code_statut' => 'PEI',
            'libelle_statut' => 'Pré-enrôlement inachevé (non-payées)',
            'icone' => 'money-check',
        ]);
        CustomersStatut::create([
            'code_statut' => 'DAV',
            'libelle_statut' => 'Documents justificatifs en attente de vérification',
            'icone' => 'hourglass-half',
        ]);
        CustomersStatut::create([
            'code_statut' => 'DR',
            'libelle_statut' => 'Documents refusés',
            'icone' => 'times-circle',
        ]);
        CustomersStatut::create([
            'code_statut' => 'FPD',
            'libelle_statut' => 'Fiche de pré-enrôlement disponible',
            'icone' => 'check',
        ]);
        CustomersStatut::create([
            'code_statut' => 'FPT',
            'libelle_statut' => 'Fiche de pré-enrôlement téléchargée',
            'icone' => 'hand-receiving',
        ]);
    }

}
