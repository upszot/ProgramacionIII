<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>1er Parcial</title>
</head>

<body>
    
    <?php
    require_once './clases/Pizzeria.php';
    require_once './clases/Generales.php';
   $PATH_ARCHIVOS = './archivos';
   $ID =0;

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $metodo = $_SERVER['REQUEST_METHOD'];
    echo $metodo . "<br>";
    switch ($metodo)
     {
        case "GET":
             switch (key($_GET)) 
             {
                case 'PizzaCarga':
                    echo '<br>Cargar Pizza<br>';
                    require_once 'manejadores/PizzaCarga.php';
                    break;
                
                case 'pruebas':
                    echo "BORRAR --- SOLO PARA PRUEBAS <br>";
                    echo Generales::getUsuarioMail("popo@lala.com");
                    echo Generales::getSubcadena("pepe@lala.com","@",1,true);
                    break;
             }
             break;
        case "POST":
            switch (key($_POST)) 
            {
                case 'PizzaCarga':
                    if (isset($_FILES["foto"])) {
                        echo "<br>Alta pizza Con foto<br>";
                        require_once 'manejadores/AltaPizzaConFoto.php';                        
                    }
                    break;

                case 'PizzaConsultar':                    
                    echo "<br>Consultar Pizza<br>";
                    require_once 'manejadores/PizzaConsultar.php';
                    break;                        
                case 'nuevaVenta':
                    if (isset($_FILES["foto"]))
                    {
                        echo "<br>Alta Venta - Con Imagen<br>";
                        require_once 'manejadores/AltaVentaConImagen.php';
                    }                     
                    else 
                    {
                        echo "<br>Alta Venta<br>";
                        require_once 'manejadores/AltaVenta.php';
                    }
                    break;                      
            }// FIN switch (key($_POST))             
            break;
    } //FIN switch($metodo)    

    ?>


</body>

</html>