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
    }
}
