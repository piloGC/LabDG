<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_equipos')->insert([
            'nombre' => 'Cámara Fotográfica',
            'descripcion' => 'Cámara Fotográfica bonita',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('categoria_equipos')->insert([
            'nombre' => 'Cámara de Video',
            'descripcion' => 'Cámara Video bonita',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('categoria_equipos')->insert([
            'nombre' => 'Lector de CD',
            'descripcion' => 'lector chiquito',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('categoria_equipos')->insert([
            'nombre' => 'Tableta Gráfica',
            'descripcion' => 'tableta gráfica ultimo modelo hermosa',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('categoria_equipos')->insert([
            'nombre' => 'Trípode',
            'descripcion' => 'tripode wenardo',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
