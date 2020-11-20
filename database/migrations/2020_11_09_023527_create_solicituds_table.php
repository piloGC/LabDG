<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
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

        Schema::create('solicitud_estados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('solicituds', function (Blueprint $table) {
            $table->id();
            $table->string('motivo');
            // $table->datetime('fecha_solicitud');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin');
            $table->foreignId('asignatura_id')->references('id')->on('asignaturas')->onDelete('cascade');
            $table->foreignId('estado_id')->references('id')->on('solicitud_estados')->onDelete('cascade');
            $table->foreignId('existencia_id')->references('id')->on('existencias')->onDelete('cascade');
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
        Schema::dropIfExists('solicituds');
        Schema::dropIfExists('solicitud_estados');
    }
}
