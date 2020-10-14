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
            'nombre' => 'Sanción 1',
            'descripcion' => 'Equipo dañado',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('categoria_sancions')->insert([
            'nombre' => 'Sanción 2',
            'descripcion' => 'Entrega fuera de plazo',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('categoria_sancions')->insert([
            'nombre' => 'Sanción 3',
            'descripcion' => 'Equipo encontrado en dependencias de la universidad',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
