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
        AbonnesStatut::Factory()->count(10)->create();
    }
}
