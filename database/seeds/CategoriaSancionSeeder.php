<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSancionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categoria_sancions')->insert([
            'nombre' => 'Daño Software',
            'descripcion' => 'Equipo dañado',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('categoria_sancions')->insert([
            'nombre' => 'Daño Hardware',
            'descripcion' => 'Equipo encontrado en dependencias de la universidad',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('categoria_sancions')->insert([
            'nombre' => 'Fuera de Plazo',
            'descripcion' => 'Entrega fuera de plazo',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('categoria_sancions')->insert([
            'nombre' => 'Entregado por Tercero',
            'descripcion' => 'Equipo encontrado en dependencias de la universidad',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('categoria_sancions')->insert([
            'nombre' => 'Robado',
            'descripcion' => 'Equipo encontrado en dependencias de la universidad',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
