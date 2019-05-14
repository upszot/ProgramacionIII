<?php 
	require_once "Vehiculo.php";
	require_once "Estacionamiento.php";

	$Estacion=new Estacionamiento("pepito S.A.");
	$Estacion=Estacionamiento::get_estacionados($RUTA);



	
?>