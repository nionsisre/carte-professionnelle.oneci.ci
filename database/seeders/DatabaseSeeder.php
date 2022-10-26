<?php

namespace Database\Seeders;

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
        $this->call(AbonneSeeder::class);
        $this->call(AbonnesNumeroSeeder::class);
//        $this->call(AbonnesOperateurSeeder::class);
//        $this->call(AbonnesStatutSeeder::class);
//        $this->call(AbonnesTypePieceSeeder::class);
    }
}
