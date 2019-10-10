<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol              = new \App\Roles();
        $rol->nombre      = 'Administrador';
        $rol->save();


        $rol             = new \App\Roles();
        $rol->nombre     = 'Profesor';
        $rol->save();

        $rol             = new \App\Roles();
        $rol->nombre     = 'Alumno';
        $rol->save();
    }
}
