<?php

use Illuminate\Database\Seeder;

class ArchivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $archivo                 = new \App\Archivos();
        $archivo->ID_archivo     = '1';
        $archivo->ruta           = '/files/128.jpg';
        $archivo->nombre         = 'profile';
        $archivo->save();
    }
}
