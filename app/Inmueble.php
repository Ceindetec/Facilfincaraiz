<?php

namespace facilfincaraiz;

use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    protected $table = 'inmuebles';

    protected $fillable = ['tipo_id', 'cant_banos', 'cant_habitaciones', 'cant_plantas', 'cant_garajes', 'frente', 'fondo', 'area', 'estrato', 'adicionales'];

    public function getTipo()
    {
        return $this->belongsTo('facilfincaraiz\Tipo', 'tipo_id');
    }

}
