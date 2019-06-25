<?php

/*
7-(2 pts)AltaEmpleado.php: (por POST)se recibe foto, el email del usuario , el alias,tipo y edad ,si el empleado
existe en empleados.txt, informar y no dar de alta
*/

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Alta Empleado  <br> </font>";
if (isset($_POST["alias"]) && isset($_POST["tipo"]) && isset($_POST["edad"]) && isset($_POST["email"]) && isset($_FILES["foto"])  ) {
    Pizzeria::AltaEmpleado($_POST["alias"], $_POST["tipo"], $_POST["edad"], $_POST["email"], $_FILES["foto"]);

//    function __construct($Palias ,$Ptipo, $Pemail , $Pedad, $PNomFoto)    
}
else
{
    echo "faltan datos";
}


?>



