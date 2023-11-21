<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCodeUniqueCentreInCodeCentreForOstatPlusReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ostat_plus_reports', function (Blueprint $table) {
            // Changement du nom du centre
            $table->renameColumn('code_centre', 'code_unique_centre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ostat_plus_reports', function (Blueprint $table) {
            // Récupération de l'ancien nom du centre
            $table->renameColumn('code_unique_centre', 'code_centre');
        });
    }
}
