<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservaEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reserva_estados')->insert([
            'nombre' => 'Próximo',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('reserva_estados')->insert([
            'nombre' => 'Finalizado',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('reserva_estados')->insert([
            'nombre' => 'Cancelado',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
