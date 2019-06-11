<?php

/* 5. 	GET	-> Listado filtrado por:				-> 
	- tipo o sabor de ventas.txt
	- Trae la foto
 */


echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Listar Helados Vendidos - con foto: <br> </font>";
echo $_GET["listarVendidos"];

if(isset($_GET["sabor"]) || isset($_GET["tipo"]) )
{   
    Heladeria::ListarVendidos($_GET["sabor"],$_GET["tipo"]);    
}
else{
    echo "<br>faltan datos para la busqueda<br>";
}


