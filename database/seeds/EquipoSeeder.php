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
            'nombre' => 'Camara Sony',
            'marca' => 'Sony',
            'modelo'=>'Alfa 390',
            'descripcion'=>'Este kit contiene, camara sony, lente gran angular, bolso, tarjeta de 16gb, cargador y respectivos cables',
            'imagen'=>'../images/sony.jpg',
            'categoria_id'=>1,
            'en_catalogo'=>1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('equipos')->insert([
            'nombre' => 'Camara Nikon',
            'marca' => 'Nikon',
            'modelo'=>'RX100 VI',
            'descripcion'=>'Este kit contiene, camara sony, lente gran angular, bolso, tarjeta de 16gb, cargador y respectivos cables',
            'imagen'=>'../images/nikon.jpg',
            'categoria_id'=>1,
            'en_catalogo'=>1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
