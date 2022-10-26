<?php

namespace Database\Seeders;

use App\Models\AbonnesNumero;
use Illuminate\Database\Seeder;

class AbonnesNumeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AbonnesNumero::Factory()->count(10)->create();
    }
}
