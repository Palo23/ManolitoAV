<?php

use App\User;
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

        $user = new User();
        $user->name = 'Administrador';
        $user->email = 'admin@gmail.com';
        $user->ID_rol = '1';
        $user->password = bcrypt('EoMmTa14');
        $user->ID_archivo = '1';
        $user->save();

        $user = new User();
        $user->name = 'Luis Mario Espinoza Ortiz';
        $user->email = 'luis@gmail.com';
        $user->ID_rol = '2';
        $user->password = bcrypt('asdfg123');
        $user->ID_archivo = '1';
        $user->save();
    }
}
