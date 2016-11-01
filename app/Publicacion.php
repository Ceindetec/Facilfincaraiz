<?php

namespace facilfincaraiz;

use Illuminate\Database\Eloquent\Model;
use facilfincaraiz\Galeria;

class Publicacion extends Model
{
    protected $table = 'publicaciones';

    protected $fillable = ['titulo', 'fecha', 'precio', "accion", 'descripcion','municipio_id', 'estado', 'destacado','direccion','geolocalizacion'];

    public function filtroVehiculos($idPublicacion, $categorias, $marca, $modelo, $departamento, $municipio_id){
        $sql = "";
//        dd("dlkflksdfnlksd");
        if ($idPublicacion != "")
            $sql ="SELECT * FROM vehiculos, publicaciones WHERE publicaciones.id=".$idPublicacion." AND publicaciones.articulo_id=vehiculos.id";
        else {
            $sql = "Select * FROM publicaciones, departamentos, municipios, vehiculos, galerias WHERE publicaciones.tipo='V' AND publicaciones.estado='A' AND departamentos.id=" . $departamento . " AND departamentos.id=municipios.id_dpto AND municipios.id=publicaciones.municipio_id AND publicaciones.id=galerias.publicacion_id";
            if ($municipio_id != "")
                $sql = $sql . " AND publicaciones.municipio_id=" . $municipio_id;
            $sql = $sql . " AND publicaciones.articulo_id=vehiculos.id AND vehiculos.tipo_id=" . $categorias;
            if ($marca != "")
                $sql = $sql . " AND vehiculos.marca_id=" . $marca;
            if ($modelo != "")
                $sql = $sql . " AND vehiculos.modelo=" . $modelo;
            $sql = $sql . " GROUP BY publicaciones.id";
        }
        $publicaciones = \DB::select(\DB::raw($sql));
        return $publicaciones;
    }


    public function getGaleria()
    {
        return $this->hasMany('facilfincaraiz\Galeria');
    }

    public function getUsuario()
    {
        return $this->belongsTo('facilfincaraiz\User',"user_id");
    }



    public function galeria()
    {
        return $this->hasMany('facilfincaraiz\Galeria');
    }



}












































