<?php

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Alta VENTA  <br> </font>";

if (isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_POST["cliente"])) {
    Heladeria::AltaVenta($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["cliente"],null);
}


