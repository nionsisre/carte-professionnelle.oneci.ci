<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CustomersStatutSeeder::class);
        $this->call(CustomersTypePieceSeeder::class);
        $this->call(CivilStatusSeeder::class);
    }

}
