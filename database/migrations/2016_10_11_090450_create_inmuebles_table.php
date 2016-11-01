<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInmueblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tipo_id')->unsigned();
            $table->integer('cant_banos');
            $table->integer('cant_habitaciones');
            $table->integer('cant_plantas');
            $table->integer('cant_garajes');
            $table->integer('frente');
            $table->integer('fondo');
            $table->integer('area');
            $table->integer('estrato');
            $table->string('adicionales');
            $table->timestamps();
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inmuebles');
    }
}
