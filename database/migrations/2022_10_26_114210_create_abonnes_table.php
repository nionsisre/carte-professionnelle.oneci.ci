<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('abonnes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_dossier');
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
            $table->string('document_justificatif');
            $table->string('numero_document');
            $table->string('date_expiration_document')->nullable();
            $table->string('type_cni')->nullable();
            $table->timestamps();

            $table->foreignIdFor(\App\Models\AbonnesTypePiece::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('abonnes');
    }

}
