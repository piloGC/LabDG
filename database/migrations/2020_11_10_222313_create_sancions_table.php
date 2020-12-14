<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSancionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_sancions',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });
        Schema::create('estado_sancions',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });


        Schema::create('sancions', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin');
            $table->foreignId('prestamo_id')->references('id')->on('prestamos');
            $table->foreignId('categoria_id')->references('id')->on('categoria_sancions')->onDelete('cascade');
            $table->foreignId('estado_id')->references('id')->on('estado_sancions')->onDelete('cascade');
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
        Schema::dropIfExists('sancions');
        Schema::dropIfExists('categoria_sancions');
        Schema::dropIfExists('estado_sancions');
    }
}
