<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_existencias',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('disponibilidads',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });


        Schema::create('existencias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->datetime('fecha_adquisicion');
            $table->foreignId('estado_id')->references('id')->on('estado_existencias')->comment('Bueno o malo');
            $table->foreignId('disponibilidad_id')->references('id')->on('disponibilidads')->comment('disponible para prestamo o no');
            $table->foreignId('equipo_id')->references('id')->on('equipos');
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
        Schema::dropIfExists('existencias');
        Schema::dropIfExists('disponibilidads');
        Schema::dropIfExists('estado_existencias');
    }
}
