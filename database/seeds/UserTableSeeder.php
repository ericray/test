<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Eric',
            'lastname' => 'Lopez',
            'lastname2' => 'Alonzo',
            'email' => 'eric.lpez103@gmail.com',
            'password' => \Hash::make(12345),
            'grupo_id' => 0,
            'escuela_id' => 0,
            'tipo_id' => 1,
            'estado_id' => 31,
            'estatus_id' => 1,
            'sexo_id' => 1
        ]);
    }
}
