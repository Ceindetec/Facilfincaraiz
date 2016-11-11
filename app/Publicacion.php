<?php

namespace facilfincaraiz;

use Illuminate\Database\Eloquent\Model;
use facilfincaraiz\Galeria;

class Publicacion extends Model
{
    protected $table = 'publicaciones';

    protected $fillable = ['titulo', 'fecha', 'precio', "accion", 'descripcion','municipio_id', 'estado', 'destacado','direccion','geolocalizacion'];

    /**
     * Obtiene listado de publicaciones de vehiculos que correspondan a criterios especificados en filtros
     * @param $categorias int
     * @param $marca int
     * @param $modelo string
     * @param $departamento int
     * @param $municipio_id int
     * @param $pagina int
     * @param $cilindraje int
     * @param $precio string
     * @return array con listado de vehiculos coincidentes
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
            $where = $where . " AND v.modelo>=" . $arrModelo[0];
            if(count($arrModelo) > 1)
                $where = $where . " AND v.modelo<=" . $arrModelo[1];
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
            $listado = \DB::select(\DB::raw("Select p.accion, p.id, p.titulo, p.destacado, d.departamento, m.municipio, v.modelo, p.precio, v.cilindraje, v.kilometraje, g.ruta, mar.marca, t.tipo, p.fecha".$from.$where." GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC LIMIT ".($pagina-1)*10 . ",10"));
            $data["resultados"]=$listado;
            $data["mensaje"]="coincidencias exactas";
        }
        else{
            $from = " FROM publicaciones p, departamentos d , municipios m, vehiculos v";
            $where = " WHERE p.tipo='V' AND p.estado='A' AND d.id=" . $departamento . " AND d.id=m.id_dpto AND m.id=p.municipio_id AND p.articulo_id=v.id AND v.tipo_id=" . $categorias;
            $cantidadP = \DB::select(\DB::raw("Select COUNT(*) AS total ".$from.$where));
            if ($cantidadP[0]->total != 0){
                $data["cantidad"]=$cantidadP[0]->total;
                $from = $from .", galerias g, marcas mar, tipos t";
                $where = $where . " AND  p.id=g.publicacion_id AND v.marca_id=mar.id AND v.tipo_id=t.id";

                $listado = \DB::select(\DB::raw("Select p.accion, p.id, p.titulo, p.destacado, d.departamento, m.municipio, v.modelo, p.precio, v.cilindraje, v.kilometraje, g.ruta, mar.marca, t.tipo, p.fecha".$from.$where." GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC LIMIT ".($pagina-1)*10 . ",10"));
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
                    $where = $where . " AND v.modelo>=" . $arrModelo[0];
                    if(count($arrModelo) > 1)
                        $where = $where . " AND v.modelo<=" . $arrModelo[1];
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
                    $listado = \DB::select(\DB::raw("Select p.accion, p.id, p.titulo, p.destacado, d.departamento, m.municipio, v.modelo, p.precio, v.cilindraje, v.kilometraje, g.ruta, mar.marca, t.tipo, p.fecha".$from.$where." GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC LIMIT ".($pagina-1)*10 . ",10"));
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
                        $listado = \DB::select(\DB::raw("Select p.accion, p.id, p.titulo, p.destacado, d.departamento, m.municipio, v.modelo, p.precio, v.cilindraje, v.kilometraje, g.ruta, mar.marca, t.tipo, p.fecha".$from.$where." GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC LIMIT ".($pagina-1)*10 . ",10"));
                        $data["resultados"]=$listado;
                        $data["mensaje"]="solo categoria";
                    }
                    else{
                        $from = " FROM publicaciones p, vehiculos v, galerias g, departamentos d , municipios m, marcas mar, tipos t";
                        $where = " WHERE p.tipo='V' AND p.estado='A' AND p.articulo_id=v.id AND  p.id=g.publicacion_id AND d.id=m.id_dpto AND m.id=p.municipio_id AND v.marca_id=mar.id AND v.tipo_id=t.id";
                        $listado = \DB::select(\DB::raw("Select p.accion, p.id, p.titulo, p.destacado, d.departamento, m.municipio, v.modelo, p.precio, v.cilindraje, v.kilometraje, g.ruta, mar.marca, t.tipo, p.fecha".$from.$where." GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC"));
                        $data["cantidad"] = count($listado);
                        $listado = \DB::select(\DB::raw("Select p.accion, p.id, p.titulo, p.destacado, d.departamento, m.municipio, v.modelo, p.precio, v.cilindraje, v.kilometraje, g.ruta, mar.marca, t.tipo, p.fecha".$from.$where." GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC LIMIT ".($pagina-1)*10 . ",10"));
                        $data["resultados"] = $listado;
                        $data["mensaje"]="descarte";
                    }
                }
            }
        }
        return $data;
    }

    /**
     * Obtiene listado de publicaciones de Inmuebles que correspondan a criterios especificados en filtros
     * @param $categoria int
     * @param $accion string
     * @param $rangoEstrato string
     * @param $habitaciones int
     * @param $banos int
     * @param $plantas int
     * @param $rangoArea string
     * @param $rangoPrecio string
     * @param $departamento int
     * @param $municipio int
     * @param $pagina int
     * @return array con listado de inmuebles coincidentes
     */
    public function filtrarInmuebles($tipo, $categoria, $accion, $rangoEstrato, $habitaciones, $banos, $plantas, $rangoArea, $rangoPrecio, $departamento, $municipio, $pagina){
        $selectComplejo="Select p.accion, p.id, p.titulo, p.destacado, d.departamento, m.municipio, p.precio, i.cant_banos, i.cant_habitaciones, i.cant_plantas, i.cant_garajes, i.frente, i.fondo, i.area, i.estrato, g.ruta, p.fecha, t.tipo";
        $tablasBasicas = " FROM publicaciones p, inmuebles i, departamentos d, municipios m";
        //siempre van en la busqueda
        $relacionesBasicas = " WHERE p.tipo='" . $tipo . "' AND p.estado='A' AND p.articulo_id=i.id AND d.id=m.id_dpto AND m.id=p.municipio_id";
        $accionEstrato = " AND p.accion='" . $accion . "'";
        $arrayEstrato = explode(" - ", $rangoEstrato);
        $accionEstrato = $accionEstrato . " AND i.estrato>=" . $arrayEstrato[0];
        if(count($arrayEstrato) > 1)
            $accionEstrato = $accionEstrato . " AND i.estrato<=" . $arrayEstrato[1];

        $tipo = " AND i.tipo_id=" . $categoria ;
        $departamento = " AND d.id=" . $departamento;//

        $todosFiltros = '';
        if ($municipio != "")
            $todosFiltros = $todosFiltros . " AND p.municipio_id=" . $municipio;
        if ($habitaciones != "")
            $todosFiltros = $todosFiltros . " AND i.cant_habitaciones=" . $habitaciones;
        if ($banos != "")
            $todosFiltros = $todosFiltros . " AND i.cant_banos=" . $banos;
        if ($plantas != "")
            $todosFiltros = $todosFiltros . " AND i.cant_plantas=" . $plantas;
        if ($rangoArea != ""){
            $arrayArea = explode(" - ", $rangoArea);
//            dd($arrayArea);
            if ($arrayArea[0] != "")
                $todosFiltros = $todosFiltros . " AND i.area>=" . $arrayArea[0];
            if($arrayArea[1] != "")
                $todosFiltros = $todosFiltros . " AND i.area<=" . $arrayArea[1];
        }
        if ($rangoPrecio != ""){
            $arrayPrecio = explode(" - ", $rangoPrecio);
            if ($arrayPrecio[0] != "")
                $todosFiltros = $todosFiltros . " AND p.precio>=" . $arrayPrecio[0];
            if ($arrayPrecio[1] != "")
                $todosFiltros = $todosFiltros . " AND p.precio<=" . $arrayPrecio[1];
        }
        $otrasTablas = ", galerias g, tipos t";
        $whereExtras = " AND  p.id=g.publicacion_id AND i.tipo_id=t.id";
        $final = " GROUP BY p.id ORDER BY p.destacado DESC, p.fecha DESC LIMIT ".($pagina-1)*10 . ",10";

        $cantidadP = \DB::select(\DB::raw("Select COUNT(*) AS total " . $tablasBasicas . $relacionesBasicas . $accionEstrato . $tipo . $departamento . $todosFiltros));
        if ($cantidadP[0]->total != 0){
//            dd("coincidencias exactas");
            $data["cantidad"]=$cantidadP[0]->total;
            $data["resultados"] = \DB::select(\DB::raw($selectComplejo . $tablasBasicas . $otrasTablas . $relacionesBasicas . $accionEstrato . $tipo . $departamento . $todosFiltros . $whereExtras. $final));
            $data["mensaje"]="coincidencias exactas";
        }
        else{
//
            $cantidadP = \DB::select(\DB::raw("Select COUNT(*) AS total ".$tablasBasicas . $relacionesBasicas . $accionEstrato . $tipo . $departamento));
            if ($cantidadP[0]->total != 0){
//                dd("solo tipo, estrato, accion y departamento");
                $data["cantidad"]=$cantidadP[0]->total;
                $data["resultados"] = \DB::select(\DB::raw($selectComplejo.$tablasBasicas . $otrasTablas . $relacionesBasicas . $accionEstrato . $tipo . $departamento . $whereExtras. $final));
                $data["mensaje"]="solo tipo, estrato, accion y departamento";
            }
            else{
                $cantidadP = \DB::select(\DB::raw("Select COUNT(*) AS total ".$tablasBasicas . $relacionesBasicas . $accionEstrato . $tipo . $todosFiltros));
                if ($cantidadP[0]->total != 0){
////                    dd("exacto sin dpto");
                    $data["cantidad"]=$cantidadP[0]->total;
                    $data["resultados"] = \DB::select(\DB::raw($selectComplejo . $tablasBasicas . $otrasTablas . $relacionesBasicas . $accionEstrato . $tipo . $todosFiltros . $whereExtras. $final));
                    $data["mensaje"]="exacto sin dpto";
                }
                else{
                    $cantidadP = \DB::select(\DB::raw("Select COUNT(*) AS total " . $tablasBasicas . $relacionesBasicas . $tipo . $departamento));
                    if ($cantidadP[0]->total != 0){
//                        dd("solo dpto y categoria");
                        $data["cantidad"] = $cantidadP[0]->total;
                        $data["resultados"] = \DB::select(\DB::raw($selectComplejo . $tablasBasicas . $otrasTablas . $relacionesBasicas . $tipo . $departamento . $whereExtras .$final));
                        $data["mensaje"]="solo dpto y categoria";
                    }
                    else{
                        $cantidadP = \DB::select(\DB::raw("Select COUNT(*) AS total " . $tablasBasicas . $relacionesBasicas . $tipo));
                        if ($cantidadP[0]->total != 0) {
//                            dd("solo categoria");
                            $data["cantidad"] = $cantidadP[0]->total;
                            $data["resultados"] = \DB::select(\DB::raw($selectComplejo . $tablasBasicas . $otrasTablas. $relacionesBasicas . $tipo . $whereExtras . $final));
                            $data["mensaje"]="solo categoria";
                        }
                        else{
//                            dd("descarte");
                            $sentencia = $selectComplejo . $tablasBasicas . $otrasTablas . $relacionesBasicas . $whereExtras;
                            $listado = \DB::select(\DB::raw($sentencia . " GROUP BY p.id"));
                            $data["cantidad"] = count($listado);
                            $data["resultados"] = \DB::select(\DB::raw($sentencia . $final));
                            $data["mensaje"]="descarte";
                        }
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

    public function getVehiculo()
    {
        return $this->belongsTo('facilfincaraiz\Vehiculo', 'articulo_id');
    }

    public function getInmueble()
    {
        return $this->belongsTo('facilfincaraiz\Inmueble', 'articulo_id');
    }

    public function galeria()
    {
        return $this->hasMany('facilfincaraiz\Galeria');
    }

    public function getMunicipio()
    {
        return $this->belongsTo('facilfincaraiz\Municipio', 'municipio_id');
    }



}












































