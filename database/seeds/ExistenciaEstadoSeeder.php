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
        DB::table('existencia_estados')->insert([
            'nombre' => 'Bueno',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('existencia_estados')->insert([
            'nombre' => 'Malo',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('existencia_estados')->insert([
            'nombre' => 'Otro',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
