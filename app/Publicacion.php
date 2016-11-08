<?php

namespace facilfincaraiz;

use Illuminate\Database\Eloquent\Model;
use facilfincaraiz\Galeria;

class Publicacion extends Model
{
    protected $table = 'publicaciones';

    protected $fillable = ['titulo', 'fecha', 'precio', "accion", 'descripcion','municipio_id', 'estado', 'destacado','direccion','geolocalizacion'];

    /**
     * Obtiene listado de publicaciones que correspondan a criterios especificados en filtros
     */
    public function filtrarVehiculos($categorias, $marca, $modelo, $departamento, $municipio_id, $pagina, $cilindraje, $precio){
        $from = " FROM publicaciones p, departamentos d , municipios m, vehiculos v";
        $where = " WHERE p.tipo='V' AND p.estado='A' AND d.id=" . $departamento . " AND d.id=m.id_dpto AND m.id=p.municipio_id";
        if ($municipio_id != "")
            $where = $where . " AND p.municipio_id=" . $municipio_id;
        $where = $where . " AND p.articulo_id=v.id AND v.tipo_id=" . $categorias;
        if ($marca != "")
            $where = $where . " AND v.marca_id=" . $marca;
        if ($modelo != ""){
            $arrModelo = explode(" - ", $modelo);
            if(count($arrModelo) == 1)
                $where = $where . " AND v.modelo>=" . $arrModelo[0];
            else
                $where = $where . " AND v.modelo>=" . $arrModelo[0] . " AND v.modelo<=" . $arrModelo[1];
        }
        if ($cilindraje != ""){
            $where = $where . " AND v.cilindraje=" . $cilindraje;
        }
        if ($precio != ""){
            $arrPrecio = explode("-", $precio);
            $where = $where . " AND p.precio>=" . $arrPrecio[0] . " AND p.precio<=" . $arrPrecio[1];
        }
        $cantidadP = \DB::select(\DB::raw("Select COUNT(*) AS total ".$from.$where));
        if ($cantidadP[0]->total != 0){
            $data["cantidad"]=$cantidadP[0]->total;
            $from = $from .", galerias g, marcas mar, tipos t";
            $where = $where . " AND  p.id=g.publicacion_id AND v.marca_id=mar.id AND v.tipo_id=t.id";
            $listado = \DB::select(\DB::raw("Select p.id, p.titulo, p.destacado, d.departamento, m.municipio, v.modelo, p.precio, v.cilindraje, v.kilometraje, g.ruta, mar.marca, t.tipo, p.fecha".$from.$where." GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC LIMIT ".($pagina-1)*10 . ",10"));
            $data["resultados"]=$listado;
            $data["mensaje"]="coincidencias exactas";
        }
        else{
            $data["mensaje"]="sugerencias";
            $from = " FROM publicaciones p, departamentos d , municipios m, vehiculos v";
            $where = " WHERE p.tipo='V' AND p.estado='A' AND d.id=" . $departamento . " AND d.id=m.id_dpto AND m.id=p.municipio_id AND p.articulo_id=v.id AND v.tipo_id=" . $categorias;
            $cantidadP = \DB::select(\DB::raw("Select COUNT(*) AS total ".$from.$where));
            if ($cantidadP[0]->total != 0){
                $data["cantidad"]=$cantidadP[0]->total;
                $from = $from .", galerias g, marcas mar, tipos t";
                $where = $where . " AND  p.id=g.publicacion_id AND v.marca_id=mar.id AND v.tipo_id=t.id";
                $listado = \DB::select(\DB::raw("Select p.id, p.titulo, p.destacado, d.departamento, m.municipio, v.modelo, p.precio, v.cilindraje, v.kilometraje, g.ruta, mar.marca, t.tipo, p.fecha".$from.$where." GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC LIMIT ".($pagina-1)*10 . ",10"));
                $data["resultados"]=$listado;
                $data["mensaje"]="solo dpto y categoria";
            }
            else{
                $from = " FROM publicaciones p, vehiculos v";
                $where = " WHERE p.tipo='V' AND p.estado='A' AND p.articulo_id=v.id AND v.tipo_id=" . $categorias;
                if ($marca != "")
                    $where = $where . " AND v.marca_id=" . $marca;
                if ($modelo != ""){
                    $arrModelo = explode(" - ", $modelo);
                    if(count($arrModelo) == 1)
                        $where = $where . " AND v.modelo>=" . $arrModelo[0];
                    else
                        $where = $where . " AND v.modelo>=" . $arrModelo[0] . " AND v.modelo<=" . $arrModelo[1];
                }
                if ($cilindraje != ""){
                    $where = $where . " AND v.cilindraje=" . $cilindraje;
                }
                if ($precio != ""){
                    $arrPrecio = explode("-", $precio);
                    $where = $where . " AND p.precio>=" . $arrPrecio[0] . " AND p.precio<=" . $arrPrecio[1];
                }

                $cantidadP = \DB::select(\DB::raw("Select COUNT(*) AS total ".$from.$where));
                if ($cantidadP[0]->total != 0){
                    $data["cantidad"]=$cantidadP[0]->total;
                    $from = $from .", galerias g, departamentos d , municipios m, marcas mar, tipos t";
                    $where = $where . " AND p.id=g.publicacion_id AND d.id=m.id_dpto AND m.id=p.municipio_id AND v.marca_id=mar.id AND v.tipo_id=t.id";
                    $listado = \DB::select(\DB::raw("Select p.id, p.titulo, p.destacado, d.departamento, m.municipio, v.modelo, p.precio, v.cilindraje, v.kilometraje, g.ruta, mar.marca, t.tipo, p.fecha".$from.$where." GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC LIMIT ".($pagina-1)*10 . ",10"));
                    $data["resultados"]=$listado;
                    $data["mensaje"]="exacto sin dpto";
                }
                else{
                    $from = " FROM publicaciones p, vehiculos v";
                    $where = " WHERE p.tipo='V' AND p.estado='A' AND p.articulo_id=v.id AND v.tipo_id=" . $categorias;
                    $cantidadP = \DB::select(\DB::raw("Select COUNT(*) AS total ".$from.$where));
                    if ($cantidadP[0]->total != 0){
                        $data["cantidad"]=$cantidadP[0]->total;
                        $from = $from .", galerias g, departamentos d , municipios m, marcas mar, tipos t";
                        $where = $where . " AND  p.id=g.publicacion_id AND d.id=m.id_dpto AND m.id=p.municipio_id";
                        $listado = \DB::select(\DB::raw("Select p.id, p.titulo, p.destacado, d.departamento, m.municipio, v.modelo, p.precio, v.cilindraje, v.kilometraje, g.ruta, mar.marca, t.tipo, p.fecha".$from.$where." GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC LIMIT ".($pagina-1)*10 . ",10"));
                        $data["resultados"]=$listado;
                        $data["mensaje"]="solo categoria";
                    }
                    else{
                        $from = " FROM publicaciones p, vehiculos v, galerias g, departamentos d , municipios m, marcas mar, tipos t";
                        $where = " WHERE p.tipo='V' AND p.estado='A' AND p.articulo_id=v.id AND  p.id=g.publicacion_id AND d.id=m.id_dpto AND m.id=p.municipio_id AND v.marca_id=mar.id AND v.tipo_id=t.id";
                        $listado = \DB::select(\DB::raw("Select p.id, p.titulo, p.destacado, d.departamento, m.municipio, v.modelo, p.precio, v.cilindraje, v.kilometraje, g.ruta, mar.marca, t.tipo, p.fecha".$from.$where." GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC"));
                        $data["cantidad"] = count($listado);
                        $listado = \DB::select(\DB::raw("Select p.id, p.titulo, p.destacado, d.departamento, m.municipio, v.modelo, p.precio, v.cilindraje, v.kilometraje, g.ruta, mar.marca, t.tipo, p.fecha".$from.$where." GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC LIMIT ".($pagina-1)*10 . ",10"));
                        $data["resultados"] = $listado;
                        $data["mensaje"]="descarte";
                    }
                }
            }
        }
        return $data;
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












































