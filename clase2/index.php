<?php 
/*
Aplicaciones Nº ( producto conteiner) 
<br> los containers puede ser (chico o grande) con una capacidad de 1000kg o 2500kg o 9000kg <br> <br> 
los productos tiene un identificador  unico de producto, el nombre, el importador, el pais de origen y los kilos <br> si el producto ya existe se suma los kilos
*/

require_once "Guia_PHP_Clase2.php";
require_once "conteiner.php";			  
require_once "producto.php";

$miC=new conteiner(100);
$miP=new producto();

echo "$Enunciado.<br>";
$miC->mostrar();
$miP->mostrar();

echo "<br>--------------<br>";
$miC->agregarProducto($miP);
$miC->agregarProducto($miP);

$miC->mostrar();
?>
