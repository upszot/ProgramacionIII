<?php


/* B- (1 pt.) PizzaCarga.php: (por GET)
se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de
unidades),Sabor(“muzza”;”jamón”; “especial”). 
Se guardan los datos en en el archivo de texto Pizza.txt, tomando
un id autoincremental como identificador . */

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Alta Pizza <br> </font>";

if( isset($_GET["sabor"]) &&  isset($_GET["tipo"]) &&  isset($_GET["cantidad"]) &&  isset($_GET["precio"]))
{
    Pizzeria::agregarPizza($_GET["sabor"],$_GET["tipo"],$_GET["cantidad"],$_GET["precio"]);

}

?>