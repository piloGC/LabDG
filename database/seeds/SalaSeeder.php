<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salas')->insert([
            'codigo_interno'=>'s_01',
            'nombre' => 'Sala A',
            'estado'=>'Disponible',
            'capacidad'=>'20',
            'internet'=>'Si',
            'aire_acondicionado'=>'Si',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('salas')->insert([
            'codigo_interno'=>'s_02',
            'nombre' => 'Sala B',
            'estado'=>'No disponible',
            'capacidad'=>'20',
            'internet'=>'Si',
            'aire_acondicionado'=>'Si',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
