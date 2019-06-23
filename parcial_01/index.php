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
    echo "Metodo= " . $metodo . "<br>";
    switch ($metodo)
     {
        case "GET":
             switch (key($_GET)) 
             {
                case 'PizzaCarga':
                    //echo '<br>(index) Cargar Pizza<br>';
                    require_once 'manejadores/PizzaCarga.php';
                    break;
                
                case 'listado':
                    echo "<br>(index) Listado<br>";
                    require_once 'manejadores/ListadoDeImagenes.php';
                    break;
             }
             break;
        case "POST":
            switch (key($_POST)) 
            {
                case 'PizzaCarga':
                    if (isset($_FILES["foto"])) {
                        //echo "<br>(index) Alta pizza Con foto<br>";
                        require_once 'manejadores/AltaPizzaConFoto.php';                        
                    }
                    break;

                case 'PizzaConsultar':                    
                    //echo "<br>(index) Consultar Pizza<br>";
                    require_once 'manejadores/PizzaConsultar.php';
                    break;                        
                case 'nuevaVenta':
                    if (isset($_FILES["foto"]))
                    {
                        echo "<br>(index) Alta Venta - Con Imagen<br>";
                        require_once 'manejadores/AltaVentaConImagen.php';
                    }                     
                    else 
                    {
                        //echo "<br>(index) Alta Venta<br>";
                        require_once 'manejadores/AltaVenta.php';
                    }
                    break;                      
            }// FIN switch (key($_POST))             
            break;

        case "PUT":
            //PizzaCargaPlus':
            //echo '<br>(index) Cargar Pizza Pluz - PUT<br>';
            require_once 'manejadores/PizzaCargaPlus.php';
            break;

        case "DELETE":
            //echo "<br>(index) Borrar Pizza<br>";
            require_once 'manejadores/borrarPizza.php';
            break;


        } //FIN switch($metodo)    

    ?>


</body>

</html>