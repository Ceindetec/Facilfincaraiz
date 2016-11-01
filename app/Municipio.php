<?php

namespace facilfincaraiz;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';

    public function getDepartamento()
    {
        return $this->belongsTo('facilfincaraiz\Departamento','id_dpto');
    }

}
