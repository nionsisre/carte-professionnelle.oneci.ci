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
            $table->string('code_centre',100);
            $table->string('date',20);
            $table->string('value',50);
            $table->string('status',100)->nullable();
            $table->string('doer_uid',100)->nullable();
            $table->string('doer_name',200)->nullable();
            $table->string('reason',200)->nullable();
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
