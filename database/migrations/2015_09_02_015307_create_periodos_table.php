<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos',function(Blueprint $table){
            $table->increments('id');
            $table->string('descripcion');
            $table->integer('ano_inicio');
            $table->integer('ano_fin');
            $table->integer('escuela_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('periodos');
    }
}
