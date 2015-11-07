<?php

use Illuminate\Database\Seeder;

class SexoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sexos')->insert([
            'descripcion' => 'Hombre'
        ]);

        DB::table('sexos')->insert([
            'descripcion' => 'Mujer'
        ]);
    }
}
