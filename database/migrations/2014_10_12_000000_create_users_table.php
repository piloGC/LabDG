<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('run')->unique();
            $table->string('phone');
            $table->string('email')->unique();
            $table->foreignId('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            $table->string('carrera')->nullable();
            $table->string('anio_ingreso')->nullable();
            $table->string('campus')->nullable();
            $table->string('activo')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }
}
