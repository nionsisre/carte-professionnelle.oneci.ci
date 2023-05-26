<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnesNumerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnes_numeros', function (Blueprint $table) {
            $table->id();
            $table->string('numero_de_telephone');
            $table->string('otp_code')->nullable();
            $table->string('otp_sms')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('cinetpay_api_response_id')->nullable();
            $table->string('cinetpay_code')->nullable();
            $table->string('cinetpay_message')->nullable();
            $table->string('cinetpay_data_amount')->nullable();
            $table->string('cinetpay_data_currency')->nullable();
            $table->string('cinetpay_data_status')->nullable();
            $table->string('cinetpay_data_payment_method')->nullable();
            $table->string('cinetpay_data_description')->nullable();
            $table->string('cinetpay_data_metadata')->nullable();
            $table->string('cinetpay_data_operator_id')->nullable();
            $table->string('cinetpay_data_payment_date')->nullable();
            $table->string('certificate_download_link')->nullable();
            $table->timestamps();

            $table->foreignIdFor(\App\Models\Abonne::class)->nullable();
            $table->foreignIdFor(\App\Models\AbonnesOperateur::class)->nullable();
            $table->foreignIdFor(\App\Models\AbonnesStatut::class)->nullable();
            $table->string('observation')->nullable();
            $table->string('user_validation')->nullable();
            $table->string('date_validation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abonnes_numeros');
    }
}
