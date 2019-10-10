<?php

use App\Roles;
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
        $role_admin = Roles::where('ID_rol', '1')->first();
        $role_profesor  = Roles::where('ID_rol', '2')->first();
        $role_alumno  = Roles::where('ID_rol', '3')->first();

        $user = new User();
        $user->name = 'Administrador';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('EoMmTa14');
        $user->ID_archivo = '1';
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
