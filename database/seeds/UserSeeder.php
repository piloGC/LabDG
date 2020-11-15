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
            'username' =>"12.123.123-1",
            'phone' =>'123456789',
            'email' => 'correo@correo.com',
            'role_id'=>1,
            'password' => Hash::make('correo123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $user2 = User::create([
            'name' => 'Pilar ',
            'lastname'=>'Gonzalez Cea',
            'username' =>"12.123.123-2",
            'phone' =>'123456789',
            'email' => 'correo2@correo.com',
            'role_id'=>2,
            'password' => Hash::make('correo123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $user2 = User::create([
            'name' => 'Eduardo ',
            'lastname'=>'Fuentes Reyes',
            'username' =>"12.123.123-3",
            'phone' =>'123456789',
            'email' => 'correo3@correo.com',
            'role_id'=>2,
            'password' => Hash::make('correo123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
