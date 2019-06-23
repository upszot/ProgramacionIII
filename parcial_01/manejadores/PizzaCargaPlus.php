<?php

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br> PizzaCargaPlus <br> </font>";

parse_str(file_get_contents("php://input"), $_PUT);

    // echo "<br> Valores por put<br>";
    // var_dump($_PUT);
    // echo "<br>----------------<br>";
    Pizzeria::modificarPizza($_PUT);

?>