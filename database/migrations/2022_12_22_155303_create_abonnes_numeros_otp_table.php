<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnesNumerosOtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnes_numeros_otp', function (Blueprint $table) {
            $table->id();
            $table->string('msisdn')->nullable();
            $table->string('form_number')->nullable();
            $table->string('otp_code')->nullable();
            $table->string('otp_sms_title')->nullable();
            $table->string('otp_sms_message')->nullable();
            $table->string('otp_verification_status')->nullable();
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
        Schema::dropIfExists('abonnes_numeros_otp');
    }
}
