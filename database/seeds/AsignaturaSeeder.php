<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('asignaturas')->insert([
            'nombre' => 'Edición audiovisual',
            'codigo' => 'A1'
        ]);
        DB::table('asignaturas')->insert([
            'nombre' => 'Producción audiovisual',
            'codigo' => 'A2'
        ]);
        DB::table('asignaturas')->insert([
            'nombre' => 'Fotografía aplicada',
            'codigo' => 'A3'
        ]);
    }
}
