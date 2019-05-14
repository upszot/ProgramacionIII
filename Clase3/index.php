<?php 

// $RUTA="Vehiculo.txt";
// require_once "traerVehiculo.php";
// require_once "CrearVehiculo.php";

$metodo=$_SERVER["REQUEST_METHOD"];
switch ($metodo) {
	case 'GET':
		# traer datos
		echo "por get";
		// require_once "traerVehiculo.php";
		if($_GET["quehacer"]=="traertodos")
		{
			//lala
		}
		break;
	case 'POST':
		# altas
		echo "por post";
		break;
	case 'DELETE':
		# eliminar
		echo "por delete";
		break;
	case 'PUT':
		# para modificar
		echo "por put";
		break;		
	default:
		# code...
		echo "por otra cosa: $metodo";
		break;
}

?>