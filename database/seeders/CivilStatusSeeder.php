<?php

namespace Database\Seeders;

use App\Models\CivilStatus;
use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CivilStatus::create([
            'code_statut' => 'CEL',
            'libelle_statut' => 'Célibataire',
            'icone' => ''
        ]);
        CivilStatus::create([
            'code_statut' => 'MAR',
            'libelle_statut' => 'Marié(e)',
            'icone' => ''
        ]);
        CivilStatus::create([
            'code_statut' => 'DIV',
            'libelle_statut' => 'Divorcé(e)',
            'icone' => ''
        ]);
        CivilStatus::create([
            'code_statut' => 'VEU',
            'libelle_statut' => 'Veuf / veuve',
            'icone' => ''
        ]);
    }
}
