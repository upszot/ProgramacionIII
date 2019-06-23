<?php

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Alta VENTA con imagen <br> </font>";

if (isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_POST["email"])) {
    Pizzeria::AltaVenta($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["email"],$_FILES["foto"]);
}
else
{
    echo "Falta cargar algun dato";
}

?>
