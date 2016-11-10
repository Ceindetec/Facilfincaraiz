<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<p><strong>Nombre :</strong>{!! $usuario->nombres." ".$usuario->apellidos !!}</p>
<p><strong>Email :</strong>{!! $usuario->email !!}</p>
<p><strong>Telefono</strong>{!! $usuario->telefono !!}</p>

<p><strong>Publicacion</strong> <a href="https://facilfincaraiz.com/{{$ruta}}">Ir a la publicación realizada por el usuario para la aprobación</a></p>

</body>

</html>