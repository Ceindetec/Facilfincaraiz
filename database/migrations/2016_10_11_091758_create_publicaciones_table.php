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
            $table->bigInteger('articulo_id')->unsigned();
            $table->enum("tipo",["I","V","T"]);
            $table->enum("accion",["V","A","P"]);
            $table->string('titulo');
            $table->integer('precio');
            $table->date('fecha');
            $table->text('descripcion');
            $table->enum('estado',['A','I','P']); //Activo Inactivo y Pendiente
            $table->enum('destacado',['','x']);
            $table->integer('municipio_id')->unsigned();
            $table->string('direccion');
            $table->string('geolocalizacion');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('municipio_id')->references('id')->on('municipios');
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
