<?php

use Illuminate\Database\Seeder;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            'descripcion' => 'Aguascalientes'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Baja California'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Baja California Sur'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Campeche'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Coahuila'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Colima'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Chiapas'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Chihuahua'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Distrito Federal'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Durango'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Guanajuato'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Guerrero'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Hidalgo'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Jalisco'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'México'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Michoacan'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Morelos'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Nayarit'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Nuevo León'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Oaxaca'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Puebla'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Querétaro'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Quintana Roo'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'San Luis Potosí'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Sinaloa'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Sonora'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Tabasco'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Tamaulipas'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Tlaxcala'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Veracruz'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Yucatán'
        ]);

        DB::table('estados')->insert([
            'descripcion' => 'Zacatecas'
        ]);
    }
}
