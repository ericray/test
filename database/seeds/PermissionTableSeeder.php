<?php

use Illuminate\Database\Seeder;
use App\Permission;
use Carbon\Carbon;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'ingreso_backend',
            'display_name' => 'Ingreso backend',
            'description' => 'Acceder al panel de administrador',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
