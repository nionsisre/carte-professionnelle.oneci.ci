<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('numero_dossier')->nullable();
            $table->string('nni')->nullable();
            $table->string('numero_cni')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('nom_mere')->nullable();
            $table->string('prenom_mere')->nullable();
            $table->string('nom_decision')->nullable();
            $table->string('prenom_decision')->nullable();
            $table->string('date_naissance_decision')->nullable();
            $table->string('lieu_naissance_decision')->nullable();
            $table->string('numero_decision')->nullable();
            $table->string('date_decision')->nullable();
            $table->string('lieu_decision')->nullable();
            $table->string('cni')->nullable();
            $table->string('decision_judiciaire')->nullable();
            $table->string('code_lieu_retrait')->nullable();
            $table->string('statut')->nullable();
            $table->string('certificat')->nullable();
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
            $table->string('certificate_download_link')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
