<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas',function(Blueprint $table){
            $table->increments('id');
            $table->text('nombre');
            $table->text('descripcion');
            $table->string('observaciones',300);
            $table->decimal('calificacion');
            $table->integer('estatus_id');
            $table->integer('visto');
            $table->date('fecha_entrega');
            $table->timestamp('creacion');
            $table->integer('materia_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tareas');
    }
}
