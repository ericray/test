<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones',function(Blueprint $table){
            $table->increments('id');
            $table->integer('alumno_id');
            $table->integer('materia_id');
            $table->decimal('evaluacion');
            $table->integer('periodo_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calificaciones');
    }
}
