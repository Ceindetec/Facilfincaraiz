<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        .img-circle{
            border-radius: 50%;
        }
        #mi-imagen{
            background-image: url(https://lh6.googleusercontent.com/-Yfl5sAgA5lQ/UokH4u66kgI/AAAAAAAAa7M/lpmSqWlpShE/s600/imagen.jpg);
            background-size: cover;
            width: 200px;
            height: 200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>



<div id="mi-imagen">

</div>


{{--<div style="background-image: url('http://ceindetec.org.co/img/ceind.jpg');width: 300px; height: 300px;">

</div>--}}
{{--<img src="http://ceindetec.org.co/img/ceind.jpg" alt="..." class="img-circle" style="width: 300px;height: 300px; display: block; margin-left: auto; margin-right: auto;">--}}

<p><strong>Nombre :</strong>{!! $nombre !!}</p>
<p><strong>Telefono</strong>{!! $telefono !!}</p>
<p><strong>Mensaje </strong>{!! $mensaje !!}</p>
</body>
</html>