<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareaAlumnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarea_alumno',function(Blueprint $table){
            $table->integer('tarea_id')->unsigned();
            $table->integer('alumno_id')->unsigned();

            $table->foreign('tarea_id')->references('id')->on('tareas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('alumno_id')->references('id')->on('users')
                  ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['tarea_id','alumno_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
