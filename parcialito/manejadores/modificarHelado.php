<?php
/* 
 6. 	PUT -> Modificar HeladoCarga.php 
    	- Busca por sabor y tipo, y modificas precio y cantidad.
 */

parse_str(file_get_contents("php://input"), $_PUT);

//var_dump($_PUT);
    echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>MODIFICAR: <br> </font>";
    Heladeria::modificarHelado($_PUT);

?>
