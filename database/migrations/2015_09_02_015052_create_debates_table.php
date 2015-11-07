<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debates',function(Blueprint $table){
            $table->increments('id');
            $table->text('mensaje');
            $table->integer('creador_id');
            $table->integer('mejor_comentario_id');
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
        Schema::drop('debates');
    }
}
