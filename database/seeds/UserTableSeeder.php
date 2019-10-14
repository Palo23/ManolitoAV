<?php

use App\User;
use App\Roles;
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

        $role_admin = Roles::where('id', '1')->first();
        $role_profesor  = Roles::where('id', '2')->first();
        $role_alumno  = Roles::where('id', '3')->first();

        $user = new User();
        $user->name = 'Administrador';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('EoMmTa14');
        $user->ID_archivo = '1';
        $user->save();
        $user->roles()->attach($role_admin->id);

        $user = new User();
        $user->name = 'Jairo Enoc Monge Mojica';
        $user->email = 'monge@gmail.com';
        $user->password = bcrypt('mongemojica');
        $user->ID_archivo = '1';
        $user->save();
        $user->roles()->attach($role_alumno->id);

        $user = new User();
        $user->name = 'Luis Mario Espinoza Ortiz';
        $user->email = 'luis@gmail.com';
        $user->password = bcrypt('asdfg123');
        $user->ID_archivo = '1';
        $user->save();
        $user->roles()->attach($role_profesor->id);
    }
}
