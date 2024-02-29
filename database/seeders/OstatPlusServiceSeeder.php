<?php

namespace Database\Seeders;

use App\Models\OstatPlusService;
use Illuminate\Database\Seeder;

class OstatPlusServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        OstatPlusService::create(['label' => 'Enrôlement CNI', 'icon' => '']);
        OstatPlusService::create(['label' => 'Enrôlement VIP CNI', 'icon' => '']);
        OstatPlusService::create(['label' => 'Enrôlement VIP CR', 'icon' => '']);
        OstatPlusService::create(['label' => 'Certificat de Résidence', 'icon' => '']);
        OstatPlusService::create(['label' => 'Titre Provisoire', 'icon' => '']);
        OstatPlusService::create(['label' => 'Pré-enrôlement CR', 'icon' => '']);
        OstatPlusService::create(['label' => 'Transfert de CNI', 'icon' => '']);
        OstatPlusService::create(['label' => 'Demande de NNI', 'icon' => '']);
        OstatPlusService::create(['label' => 'Commande de TVI', 'icon' => '']);
        OstatPlusService::create(['label' => 'Retrait Spécial', 'icon' => '']);
        OstatPlusService::create(['label' => 'Enrôlement CR', 'icon' => '']);
    }
}
