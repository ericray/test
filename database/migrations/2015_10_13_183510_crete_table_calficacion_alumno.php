<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreteTableCalficacionAlumno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacion_tareas',function(Blueprint $table){
            $table->increments('id');
            $table->decimal('evaluacion');
            $table->string('observaciones',250);
            $table->integer('alumno_id')->unsigned();
            $table->integer('tarea_id')->unsigned();
            $table->integer('periodo_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calificacion_tareas');
    }
}
