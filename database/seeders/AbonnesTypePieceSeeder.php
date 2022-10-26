<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AbonnesTypePieceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AbonnesTypePiece::Factory()->count(10)->create();
    }
}
