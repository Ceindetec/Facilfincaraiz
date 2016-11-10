<?php

namespace facilfincaraiz;

use Illuminate\Database\Eloquent\Model;

class MarcaDeAgua extends Model
{
    protected $table = 'marca_de_aguas';

    protected $fillable = ['user_id', 'ruta'];

    public function getUsuario()
    {
        return $this->belongsTo('facilfincaraiz\User',"user_id");
    }


}
