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

		switch ($_GET["accion"])
		{
			/*caso 3 por GET:Se pide los estacionados y se muestra el listado .*/
			case "estacionados":
				require_once("Estacionamiento.php");
				Estacionamiento::mostrarEstacionadosCSV();
				echo "<br>";
				Estacionamiento::mostrarEstacionadosJSON();
				echo "<br>";
				Estacionamiento::mostrarEstacionadosArrayJSON();
				break;

			/*caso 4 por GET:Se pide los facturados, mostrando todos los datos y la suma total facturada*/
			case "facturados":
				require_once("Estacionamiento.php");
				Estacionamiento::mostrarFacturadosCSV();
				echo "<br>";
				Estacionamiento::mostrarFacturadosJSON();
				echo "<br>";
				Estacionamiento::mostrarFacturadosArrayJSON();
				break;
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