<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('lastname2');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('grupo_id');
            $table->integer('escuela_id');
            $table->integer('tipo_id');
            $table->integer('estado_id');
            $table->integer('estatus_id');
            $table->integer('sexo_id');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
