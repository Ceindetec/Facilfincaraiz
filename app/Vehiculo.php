<?php

namespace facilfincaraiz;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';

    protected $fillable = ['marca_id', 'tipo_id', 'modelo', 'color', 'kilometraje', 'combustible', 'valor', 'cilindraje', 'adicionales'];


}
