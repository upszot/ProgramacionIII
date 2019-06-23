<?php

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br> borrar Pizza: <br> </font>";
parse_str(file_get_contents('php://input'), $_DELETE);
Pizzeria::borrarPizza($_DELETE);

?>