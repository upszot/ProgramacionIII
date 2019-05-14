<?php 
require_once "Vehiculo.php";
Vehiculo::leer("Vehiculo.txt");
echo "------- Leidos ---------";

$vehiculos = array();
$vehiculos = Vehiculo::leer("Vehiculo.txt");

	foreach ($vehiculos as $unAuto)
	{
		$unAuto->mostrar();
	}

?>