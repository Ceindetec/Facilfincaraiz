<?php

namespace facilfincaraiz;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table = 'publicaciones';

    protected $fillable = ['titulo', 'fecha', "accion", 'descripcion', 'estado', 'destacado'];

}
