<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Razon');
            $table->string('nit');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('rol',['superAdmin', 'admin','usuario']);
            $table->string('usuario_tipo');
            $table->string('telefono',15);
            $table->string('telefono2',15);
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
        Schema::drop('users');
    }
}
