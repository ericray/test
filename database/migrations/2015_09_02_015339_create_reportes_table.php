<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes',function(Blueprint $table){
            $table->increments('id');
            $table->integer('maestro_id');
            $table->integer('alumno_id');
            $table->integer('estatus_id');
            $table->integer('escuela_id');
            $table->integer('tipo_id');
            $table->text('contenido');
            $table->integer('enterado');
            $table->timestamp('fecha');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reportes');
    }
}
