<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->bigInteger('articuli_id')->unsigned();
            $table->enum("accion",["V","A","P"]);
            $table->string('titulo');
            $table->date('fecha');
            $table->text('descripcion');
            $table->enum('estado',['A','I','P']);
            $table->enum('destacado',['','x']);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('publicaciones');
    }
}
