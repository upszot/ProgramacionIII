<?php 
	require_once "Vehiculo.php";
	$vehiculo = new Vehiculo("GLPDS","hoy",123);
	Vehiculo::guardar($vehiculo,$RUTA);
	
?>