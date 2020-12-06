<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'name' => 'Nicholas ',
            'lastname'=>'Espinoza Hasler',
            'run' =>"12.123.123-1",
            'phone' =>'123456789',
            'email' => 'laboratoriodg20@gmail.com',
            'role_id'=>1,
            'activo'=>'Si',
            'password' => Hash::make('correo123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $user2 = User::create([
            'name' => 'Pilar ',
            'lastname'=>'Gonzalez Cea',
            'run' =>"12.123.123-2",
            'phone' =>'123456789',
            'email' => 'laboratoriodg20alumno1@gmail.com',
            'role_id'=>2,
            'password' => Hash::make('correo123'),
            'carrera'=>'Diseño Gráfico',
            'anio_ingreso'=>'2015',
            'campus'=>'Fernando May',
            'activo'=>'Si',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $user2 = User::create([
            'name' => 'Eduardo ',
            'lastname'=>'Fuentes Reyes',
            'run' =>"12.123.123-3",
            'phone' =>'123456789',
            'email' => 'laboratoriodg20alumno2@gmail.com',
            'role_id'=>2,
            'password' => Hash::make('correo123'),
            'carrera'=>'Diseño Gráfico',
            'anio_ingreso'=>'2015',
            'campus'=>'Fernando May',
            'activo'=>'Si',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
