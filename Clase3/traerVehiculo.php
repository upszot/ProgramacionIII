<?php 
require_once "Vehiculo.php";


#Vehiculo::leer($RUTA);
echo "------- Leidos ---------<br>";

$vehiculos = array();
$vehiculos = Vehiculo::leer($RUTA);

	foreach ($vehiculos as $unAuto)
	{
		$unAuto->mostrar();
	}

?>