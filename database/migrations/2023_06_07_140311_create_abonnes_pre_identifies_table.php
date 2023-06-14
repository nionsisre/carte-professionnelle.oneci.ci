<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnesPreIdentifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('abonnes_pre_identifies', function (Blueprint $table) {
            $table->id();
            $table->string('numero_dossier');
            $table->string('numero_de_telephone')->nullable();
            $table->string('libelle_operateur')->nullable();
            $table->string('id_compte_operateur')->nullable();
            $table->string('nom_compte_operateur')->nullable();
            $table->string('date_validation_operateur')->nullable();
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
            $table->string('document_justificatif');
            $table->string('numero_document');
            $table->string('date_expiration_document')->nullable();
            $table->string('type_cni')->nullable();
            $table->string('photo_selfie')->nullable();
            $table->string('uniqid')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('integrator_api_response_id')->nullable();
            $table->string('integrator_code')->nullable();
            $table->string('integrator_message')->nullable();
            $table->string('integrator_data_amount')->nullable();
            $table->string('integrator_data_currency')->nullable();
            $table->string('integrator_data_status')->nullable();
            $table->string('integrator_data_payment_method')->nullable();
            $table->string('integrator_data_description')->nullable();
            $table->string('integrator_data_metadata')->nullable();
            $table->string('integrator_data_operator_id')->nullable();
            $table->string('integrator_data_payment_date')->nullable();
            $table->string('enroll_download_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('abonnes_pre_identifies');
    }
}
