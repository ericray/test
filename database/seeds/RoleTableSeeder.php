<?php

use Illuminate\Database\Seeder;
use App\Role;
use Carbon\Carbon;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'administrador',
            'display_name' => 'Administrador',
            'description' => 'Hace todo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Role::create([
            'name' => 'director',
            'display_name' => 'Director',
            'description' => 'Director de escuela',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Role::create([
            'name' => 'maestro',
            'display_name' => 'Maestro',
            'description' => 'Maestro de escuela',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
