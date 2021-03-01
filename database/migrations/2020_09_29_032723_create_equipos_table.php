<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_equipos', function (Blueprint $table) {
            $table->id();
            $table->string ('nombre');
            $table->timestamps();
        });

        Schema::create('catalogo_equipos', function (Blueprint $table) {
            $table->id();
            $table->string ('disponible');
            $table->timestamps();
        });

       

        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string ('nombre');
            $table->string ('marca');
            $table->string ('modelo');
            $table->text ('descripcion');
            $table->string ('imagen');
            $table->foreignId('categoria_id')->references('id')->on('categoria_equipos')->onDelete('cascade');
            $table->foreignId('en_catalogo')->references('id')->on('catalogo_equipos')->onDelete('cascade')->comment('Si esta disponible para estar en sistema');
            $table->softDeletes();
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
        Schema::dropIfExists('catalogo_equipos');
        Schema::enableForeignKeyConstraints();

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('categoria_equipos');
        Schema::enableForeignKeyConstraints();

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('equipos');
        Schema::enableForeignKeyConstraints();
    }
}
