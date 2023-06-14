<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnesIdentifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnes_identifies', function (Blueprint $table) {
            $table->id();
            $table->string('numero_dossier');
            $table->string('numero_de_telephone')->nullable();
            $table->string('libelle_operateur')->nullable();
            $table->string('status');
            $table->string('nom');
            $table->string('nom_epouse')->nullable();
            $table->string('prenoms');
            $table->string('date_de_naissance');
            $table->string('lieu_de_naissance');
            $table->string('genre');
            $table->string('domicile');
            $table->string('profession');
            $table->string('nationalite');
            $table->string('email')->nullable();
            $table->string('libelle_document_justificatif');
            $table->string('document_justificatif');
            $table->string('numero_document');
            $table->string('date_expiration_document')->nullable();
            $table->string('type_cni')->nullable();
            $table->string('photo_selfie')->nullable();
            $table->string('uniqid')->nullable();
            $table->string('date_utilisation_numero')->nullable();
            $table->string('date_arret_utilisation_numero')->nullable();
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
        Schema::dropIfExists('abonnes_identifies');
    }
}
