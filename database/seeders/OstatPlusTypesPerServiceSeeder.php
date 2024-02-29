<?php

namespace Database\Seeders;

use App\Models\OstatPlusService;
use App\Models\OstatPlusTypeService;
use App\Models\OstatPlusTypesPerService;
use Illuminate\Database\Seeder;

class OstatPlusTypesPerServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Services Seeder
        $ostat_plus_types_services = OstatPlusTypeService::all();
        $ostat_plus_services = OstatPlusService::all();
        foreach($ostat_plus_services as $ostat_plus_service) {
            foreach ($ostat_plus_types_services as $ostat_plus_type_service) {
                OstatPlusTypesPerService::create(['ostat_plus_service_id' => $ostat_plus_service->id, 'ostat_plus_type_service_id' => $ostat_plus_type_service->id, 'state' => 1]);
            }
        }
    }
}
