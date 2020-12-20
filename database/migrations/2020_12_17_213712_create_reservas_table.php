<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_estados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_reserva');
            $table->string('encargado_reserva');
            $table->datetime('dia_reserva');
            $table->string('hora_inicio');
            $table->string('hora_fin');
            $table->string('tipo_publico');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('sala_id')->references('id')->on('salas');
            $table->foreignId('estado_id')->references('id')->on('reserva_estados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
