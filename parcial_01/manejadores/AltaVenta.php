<?php

/*
a- (2 pts.) AltaVenta.php: (por POST)
se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.txt, y hay stock guardar en el archivo de texto Venta.txt todos los datos y descontar la cantidad vendida .

*/

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Alta VENTA  <br> </font>";
if (isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_POST["email"])) {
    Pizzeria::AltaVenta($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["email"],null);
}


?>



