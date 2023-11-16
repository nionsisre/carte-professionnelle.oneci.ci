<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOstatPlusReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ostat_plus_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\OstatPlusService::class)->nullable();
            $table->foreignIdFor(\App\Models\OstatPlusTypeService::class)->nullable();
            $table->string('value',50);
            $table->string('status',100);
            $table->string('reason',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ostat_plus_reports');
    }
}
