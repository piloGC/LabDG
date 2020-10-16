<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExistenciaEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('existencia_disponibilidads')->insert([
            'nombre' => 'Disponible',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('existencia_disponibilidads')->insert([
            'nombre' => 'Ocupado',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('existencia_disponibilidads')->insert([
            'nombre' => 'en Laboratorio',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
