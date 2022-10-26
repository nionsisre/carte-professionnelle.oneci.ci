<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AbonnesOperateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AbonnesOperateur::Factory()->count(10)->create();
    }
}
