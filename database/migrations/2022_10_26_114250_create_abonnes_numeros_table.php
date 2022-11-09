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
            /*$table->unsignedBigInteger('abonnes_operateurs_id');*/
            $table->string('numero_de_telephone');
            $table->timestamps();

            $table->foreignIdFor(\App\Models\Abonne::class)->nullable();
            $table->foreignIdFor(\App\Models\AbonnesOperateur::class)->nullable();
            $table->foreignIdFor(\App\Models\AbonnesStatut::class)->nullable();
            /*$table->foreign('abonnes_operateurs_id')->references('id')->on('abonnes_operateurs')
            ->nullable()
            ->constrained()
            ->OnUpdate('cascade')
            ->OnDelete('set null');
            $table->engine('InnoDB');*/

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
