<?php

/*2- (2pt.) PizzaConsultar.php: (por POST)
Se ingresa Sabor,Tipo, si coincide con algún registro del archivo
Helados.
 */

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Consultar Pizza: <br> </font>";


if( isset($_POST["sabor"]) &&  isset($_POST["tipo"]))
{
    Pizzeria::BuscaSaborTipo($_POST["sabor"],$_POST["tipo"]);
}

?>
