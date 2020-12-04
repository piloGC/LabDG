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
        Schema::create('existencia_estados',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('existencia_disponibilidads',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });


        Schema::create('existencias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->datetime('fecha_adquisicion');
            $table->foreignId('estado_id')->references('id')->on('existencia_estados')->onDelete('cascade')->comment('Bueno o malo');
            $table->foreignId('disponibilidad_id')->references('id')->on('existencia_disponibilidads')->onDelete('cascade')->comment('disponible para prestamo o no');
            $table->foreignId('equipo_id')->references('id')->on('equipos')->onDelete('cascade');
            //$table->foreignId('solicitud_id')->nullable()->references('id')->on('solicituds');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('existencias');
        Schema::enableForeignKeyConstraints();

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('existencia_disponibilidads');
        Schema::enableForeignKeyConstraints();

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('existencia_estados');
        Schema::enableForeignKeyConstraints();
        
    }
}
