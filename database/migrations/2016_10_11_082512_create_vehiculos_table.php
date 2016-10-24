<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('marca_id')->unsigned();
            $table->integer('tipo_id')->unsigned();
            $table->integer('modelo');
            $table->string('color');
            $table->integer('kilometraje');
            $table->enum('combustible',['Gal','Gas','D','E','GG','GE']); // E->electrico , D-> diesel ,GAL-> Gasolina, GAS -> gas , GE-> gasolina electrico , GG-> gas y gasolina
            $table->integer('valor');
            $table->integer('cilindraje');
            $table->integer('cant_puertas');
            $table->string('adicionales');
            $table->timestamps();
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
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
        Schema::drop('vehiculos');
    }
}
