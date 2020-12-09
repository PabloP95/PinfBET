<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apuesta', function (Blueprint $table) {
            $table->increments('cod_apuesta');
            $table->timestamp('fecha');
            $table->integer('cantidad');
            $table->boolean('resultado')->nullable();
            $table->float('nota_apuesta');
            $table->string('cod_asig');

            $table->foreign('cod_asig')->references('cod_asig')->on('asignatura');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apuesta');
    }
}
