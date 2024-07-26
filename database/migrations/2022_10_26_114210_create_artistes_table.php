<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistesTable extends Migration {

    /**
     * Create the 'artistes' table in the database.
     *
     * @return void
     */
    public function up() {
        Schema::create('artistes', function (Blueprint $table) {

            $table->id();
            $table->string('numero_dossier');
            $table->string('pseudonyme')->nullable();
            $table->string('nom')->nullable();
            $table->string('nom_epouse')->nullable();
            $table->string('prenoms')->nullable();
            $table->string('genre')->nullable();
            $table->string('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('pays_naissance')->nullable();
            $table->string('nationalite')->nullable();
            $table->foreignIdFor(\App\Models\CivilStatus::class)->nullable();
            $table->string('nombre_enfants')->nullable();
            $table->string('autre_activite')->nullable();
            $table->string('ville')->nullable();
            $table->string('commune')->nullable();
            $table->string('quartier')->nullable();
            $table->string('adresse')->nullable();
            $table->string('lieu_travail')->nullable();
            $table->string('msisdn')->nullable();
            $table->string('email')->nullable();
            $table->foreignIdFor(\App\Models\ArtistesTypePiece::class)->nullable();
            $table->string('type_cni')->nullable()->nullable();
            $table->string('numero_document')->nullable();
            $table->string('document')->nullable();
            $table->string('date_expiration_document')->nullable();
            $table->string('uniqid')->nullable();
            $table->foreignIdFor(\App\Models\ArtistesStatut::class)->nullable();
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
            $table->string('certificate_download_link')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Drop the 'artistes' table from the database.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('artistes');
    }

}
