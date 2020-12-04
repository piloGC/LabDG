<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipos')->insert([
            'nombre' => 'Camara 1',
            'marca' => 'Sony',
            'modelo'=>'Alfa 390',
            'descripcion'=>'Buenisima',
            'imagen'=>'image.jpg',
            'categoria_id'=>1,
            'en_catalogo'=>1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('equipos')->insert([
            'nombre' => 'Camara 2',
            'marca' => 'Sony',
            'modelo'=>'RX100 VI',
            'descripcion'=>'Buenisima',
            'imagen'=>'image.jpg',
            'categoria_id'=>1,
            'en_catalogo'=>1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
