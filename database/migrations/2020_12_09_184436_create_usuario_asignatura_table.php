<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioAsignaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_asignatura', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('cod_asig');
            $table->float('nota', 2, 1)->nullable();
            $table->integer('curso');
            $table->bigInteger('convocatoria');

            $table->primary(['id', 'cod_asig', 'curso', 'convocatoria']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_asignatura');
    }
}
