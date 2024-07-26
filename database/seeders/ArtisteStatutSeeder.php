<?php

namespace Database\Seeders;

use App\Models\ArtistesStatut;
use Illuminate\Database\Seeder;

class ArtisteStatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArtistesStatut::create([
            'code_statut' => 'PEI',
            'libelle_statut' => 'Pré-enrôlement inachevé (non-payées)',
            'icone' => 'money-check',
        ]);
        ArtistesStatut::create([
            'code_statut' => 'DAV',
            'libelle_statut' => 'Documents justificatifs en attente de vérification',
            'icone' => 'hourglass-half',
        ]);
        ArtistesStatut::create([
            'code_statut' => 'DR',
            'libelle_statut' => 'Documents refusés',
            'icone' => 'times-circle',
        ]);
        ArtistesStatut::create([
            'code_statut' => 'FPD',
            'libelle_statut' => 'Fiche de pré-enrôlement disponible',
            'icone' => 'check',
        ]);
        ArtistesStatut::create([
            'code_statut' => 'FPT',
            'libelle_statut' => 'Fiche de pré-enrôlement téléchargée',
            'icone' => 'hand-receiving',
        ]);
    }
}
