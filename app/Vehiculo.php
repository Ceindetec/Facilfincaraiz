<?php

namespace facilfincaraiz;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';

    protected $fillable = ['marca_id', 'tipo_id', 'modelo', 'color', 'kilometraje', 'combustible', 'cilindraje', 'adicionales', 'cant_puertas'];

    public function getTipo()
    {
        return $this->belongsTo('facilfincaraiz\Tipo', 'tipo_id');
    }

    public function getMarca()
    {
        return $this->belongsTo('facilfincaraiz\Marca', 'marca_id');
    }

}
