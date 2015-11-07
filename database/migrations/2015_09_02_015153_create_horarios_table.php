<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios',function(Blueprint $table){
            $table->increments('id');
            $table->integer('grupo_id');
            $table->integer('hora_id');
            $table->integer('lun_materia_id');
            $table->integer('mar_materia_id');
            $table->integer('mie_materia_id');
            $table->integer('jue_materia_id');
            $table->integer('vie_materia_id');
            $table->integer('sab_materia_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('horarios');
    }
}
