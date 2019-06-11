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
    switch ($metodo) {
        case "GET":
             switch (key($_GET)) {
                case 'consultarHelados':
                require_once 'manejadores/ConsultarHelado.php';                     
                break;
             }
             break;
        case "POST":
            switch (key($_POST)) {
                case 'nuevoHelado':
                    //echo "Alta Helado";
                    require_once 'manejadores/HeladoCarga.php';
                    break;
                case 'nuevaVenta':
                    if (isset($_FILES["foto"]))
                    {
                        echo "nueva Venta Con Imagen";
                        require_once 'manejadores/AltaVentaConImagen.php';
                        break;
                    }                     
                    else 
                    {
                        echo "nuevaVenta";
                        require_once 'manejadores/AltaVenta.php';
                        break;
                    }
                    break;
                    
            }
            break;

        case "DELETE":
            echo "delete";
            break;

        case "PUT":
            echo "put";
            break;
    } //FIN switch($metodo)    

    ?>


</body>

</html>