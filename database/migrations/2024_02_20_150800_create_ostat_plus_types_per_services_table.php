<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOstatPlusTypesPerServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ostat_plus_types_per_services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\OstatPlusService::class)->nullable();
            $table->foreignIdFor(\App\Models\OstatPlusTypeService::class)->nullable();
            $table->integer('state')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ostat_plus_types_per_services');
    }
}
