<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recordatorios',function(Blueprint $table){
            $table->increments('id');
            $table->text('nombre');
            $table->text('descripcion');
            $table->integer('director_id');
            $table->integer('estatus_id');
            $table->date('fecha');
            $table->timestamp('creacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recordatorios');
    }
}
