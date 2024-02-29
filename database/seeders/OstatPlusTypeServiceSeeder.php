<?php

namespace Database\Seeders;

use App\Models\OstatPlusTypeService;
use Illuminate\Database\Seeder;

class OstatPlusTypeServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        OstatPlusTypeService::create(['label' => 'Première demande', 'icon' => '']);
        OstatPlusTypeService::create(['label' => 'Renouvellement', 'icon' => '']);
        OstatPlusTypeService::create(['label' => 'Duplicata', 'icon' => '']);
        OstatPlusTypeService::create(['label' => 'Correction', 'icon' => '']);
        OstatPlusTypeService::create(['label' => 'Réclamation', 'icon' => '']);
        OstatPlusTypeService::create(['label' => 'Distribution', 'icon' => '']);
        OstatPlusTypeService::create(['label' => 'Modification', 'icon' => '']);
        OstatPlusTypeService::create(['label' => 'Carte en stock', 'icon' => '']);
        OstatPlusTypeService::create(['label' => "Carte reçue aujourd'hui", 'icon' => '']);
        OstatPlusTypeService::create(['label' => 'Agent', 'icon' => '']);
        OstatPlusTypeService::create(['label' => 'Ré-enrôlement', 'icon' => '']);
        OstatPlusTypeService::create(['label' => 'Pénalité', 'icon' => '']);
    }
}
