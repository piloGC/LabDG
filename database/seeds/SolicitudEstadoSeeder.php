<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolicitudEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('solicitud_estados')->insert([
            'nombre' => 'Pendiente',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('solicitud_estados')->insert([
            'nombre' => 'Aprobada',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('solicitud_estados')->insert([
            'nombre' => 'Rechazada',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('solicitud_estados')->insert([
            'nombre' => 'En curso',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('solicitud_estados')->insert([
            'nombre' => 'Terminada',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('solicitud_estados')->insert([
            'nombre' => 'Cancelada',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
