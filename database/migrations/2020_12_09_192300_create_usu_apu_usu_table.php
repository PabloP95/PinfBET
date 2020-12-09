<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuApuUsuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usu_apu_usu', function (Blueprint $table) {
          $table->bigInteger('apostador');
          $table->integer('cod_apuesta');
          $table->bigInteger('matriculado');

          $table->primary(['apostador', 'cod_apuesta', 'matriculado']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usu_apu_usu');
    }
}
