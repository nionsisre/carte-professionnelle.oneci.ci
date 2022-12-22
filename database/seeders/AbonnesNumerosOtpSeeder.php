<?php

namespace Database\Seeders;

use App\Models\AbonnesNumerosOtp;
use Illuminate\Database\Seeder;

class AbonnesNumerosOtpSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        AbonnesNumerosOtp::Factory()->count(100)->create();
    }

}
