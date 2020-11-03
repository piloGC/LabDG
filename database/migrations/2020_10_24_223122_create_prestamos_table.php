<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo');
            $table->timestamps();
        });

        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->string('motivo');
            // $table->datetime('fecha_solicitud');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin');
            // $table->datetime('fecha_devolucion');
            $table->foreignId('asignatura_id')->references('id')->on('asignaturas')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('asignaturas');
        Schema::dropIfExists('prestamos');
    }
}
