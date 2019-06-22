<?php

echo "aca entroooooo*********";
if (isset($_POST["sabor"]) && isset( $_POST ["tipo"] ) && isset( $_POST ["cantidad"]) && isset($_POST ["precio"])&& isset($_FILES["foto"]))
{
   
    Pizzeria::agregarPizzaFoto($_POST["sabor"],$_POST["tipo"],$_POST["cantidad"],$_POST["precio"],$_FILES["foto"]);
}
?>