<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parcialito</title>
</head>

<body>
    
    <?php
    require_once './clases/Heladeria.php';
   $PATH_ARCHIVOS = './archivos';

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $metodo = $_SERVER['REQUEST_METHOD'];
    echo $metodo . "<br>";
    switch ($metodo)
     {
        case "GET":
             switch (key($_GET)) 
             {
                case '<br>consultarHelados<br>':
                require_once 'manejadores/ConsultarHelado.php';                     
                break;
             }
             break;
        case "POST":
            switch (key($_POST)) 
            {
                case 'nuevoHelado':
                    if (isset($_FILES["foto"])) {
                        echo "<br>Alta Helado Con foto<br>";
                        require_once 'manejadores/AltaHeladoConFoto.php';                        
                    }
                    else
                    {
                        echo "<br>Alta Helado - Sin foto<br>";
                        require_once 'manejadores/HeladoCarga.php';
                    }
                    break;                    
                case 'nuevaVenta':
                    if (isset($_FILES["foto"]))
                    {
                        echo "<br>Venta Helado - Con Imagen<br>";
                        require_once 'manejadores/AltaVentaConImagen.php';
                    }                     
                    else 
                    {
                        echo "<br>Venta Helado - Sin imagen<br>";
                        require_once 'manejadores/AltaVenta.php';
                    }
                    break;               
            }// FIN switch (key($_POST))             
            break;
        case "DELETE":
            echo "<br>Delete<br>";
            require_once 'manejadores/borrarHelado.php';
            break;

        case "PUT":
            echo "<br>Put<br>";
            require_once 'manejadores/modificarHelado.php';
            break;
    } //FIN switch($metodo)    

    ?>


</body>

</html>