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
            $table->text('descripcion');
            $table->timestamps();
        });

        Schema::create('sancions', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin');
            $table->foreignId('categoria_id')->references('id')->on('categoria_sancions')->onDelete('cascade');
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
    }
}
