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
            $table->integer('abonne_id');
            $table->integer('abonnes_operateur_id');
            $table->string('numero_de_telephone');
            $table->timestamps();

            /*$table->foreign('abonne_id')->references('id')->on('abonnes');
            $table->foreign('abonnes_operateur_id')->references('id')->on('abonnes_operateurs');*/
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
