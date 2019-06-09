<?php

// 1. POST  -> HeladoCarga.php
// 	- Se ingresa sabor,  tipo (crema, agua), cantidad kilos, precio
// 	- Se guardan los datos tomando el sabor y tipo como identificador.
// 	- Si existe acumula


echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Alta Helado <br> </font>";
Heladeria::agregarHelado($_POST["sabor"],$_POST["tipo"],$_POST["cantidad"],$_POST["precio"]);

?>