<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestamoEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prestamos_estados')->insert([
            'nombre' => 'Iniciado',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('prestamos_estados')->insert([
            'nombre' => 'Terminado',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
