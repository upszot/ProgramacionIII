<?php

/* 2. GET 	-> ConsultarHelado.php
	- Se ingresa tipo y sabor, si existe devuelve un "Si Hay".
	- Si "No Hay" sabor.., tiene que decir que hay de crema pero no de agua... etc.
 */

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Consultar Helado: <br> </font>";
//echo $_GET["consultaHelado"];

if( isset($_GET["sabor"]) &&  isset($_GET["tipo"]))
{
    Heladeria::BuscaSaborTipoHelado($_GET["sabor"],$_GET["tipo"]);
}
//Heladeria::ListarTodo('helado');



?>
