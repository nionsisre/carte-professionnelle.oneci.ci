<?php

namespace Database\Seeders;

use App\Models\OstatPlusTypeService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        /*$this->call(AbonnesTypePieceSeeder::class);
        $this->call(AbonnesStatutSeeder::class);
        $this->call(AbonneSeeder::class);
        $this->call(AbonnesOperateurSeeder::class);
        $this->call(AbonnesNumeroSeeder::class);
        $this->call(AbonnesNumerosOtpSeeder::class);*/
        $this->call(OstatPlusServiceSeeder::class);
        $this->call(OstatPlusTypeServiceSeeder::class);
        $this->call(OstatPlusTypesPerServiceSeeder::class);
    }
}
