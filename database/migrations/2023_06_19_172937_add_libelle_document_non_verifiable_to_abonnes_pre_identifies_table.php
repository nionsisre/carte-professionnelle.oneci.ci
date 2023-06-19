<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLibelleDocumentNonVerifiableToAbonnesPreIdentifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abonnes_pre_identifies', function (Blueprint $table) {
            $table->string('libelle_document_non_verifiable')->after('libelle_document_justificatif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('abonnes_pre_identifies', function (Blueprint $table) {
            $table->dropColumn('libelle_document_non_verifiable');
        });
    }
}
