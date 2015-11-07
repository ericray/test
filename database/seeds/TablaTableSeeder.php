<?php

use Illuminate\Database\Seeder;

class TablaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tablas')->insert([
            'descripcion' => 'usuarios'
        ]);

        DB::table('tablas')->insert([
            'descripcion' => 'recordatorios'
        ]);
    }
}
