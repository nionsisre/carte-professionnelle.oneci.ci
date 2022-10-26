<?php

namespace Database\Seeders;

use App\Models\Abonne;
use Illuminate\Database\Seeder;

class AbonneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Abonne::Factory()->count(10)->create();
    }
}
