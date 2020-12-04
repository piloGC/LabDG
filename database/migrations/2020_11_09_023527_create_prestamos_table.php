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

        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha_retiro_equipo');
            $table->datetime('fecha_devolucion')->nullable();
            $table->foreignId('solicitud_id')->references('id')->on('solicituds');
            $table->foreignId('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('prestamos');
    }
}
