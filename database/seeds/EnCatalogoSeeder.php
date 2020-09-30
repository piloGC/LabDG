<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnCatalogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalogo_equipos')->insert([
            'disponible' => 'Si',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('catalogo_equipos')->insert([
            'disponible' => 'No',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
