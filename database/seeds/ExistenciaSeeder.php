<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExistenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('existencias')->insert([
            'codigo' => 'cs_01',
            'fecha_adquisicion' => date('Y-m-d H:i:s'),
            'estado_id'=>1,
            'disponibilidad_id'=>1,
            'equipo_id'=>1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('existencias')->insert([
            'codigo' => 'cs_02',
            'fecha_adquisicion' => date('Y-m-d H:i:s'),
            'estado_id'=>1,
            'disponibilidad_id'=>2,
            'equipo_id'=>1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('existencias')->insert([
            'codigo' => 'cn_01',
            'fecha_adquisicion' => date('Y-m-d H:i:s'),
            'estado_id'=>1,
            'disponibilidad_id'=>1,
            'equipo_id'=>2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('existencias')->insert([
            'codigo' => 'cn_02',
            'fecha_adquisicion' => date('Y-m-d H:i:s'),
            'estado_id'=>1,
            'disponibilidad_id'=>1,
            'equipo_id'=>2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}