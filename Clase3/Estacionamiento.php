<?php 
	/**
	 * 
	 */
	class Estacionamiento
	{		

		private $Nombre;

		public function __construct($nombre) 	
		{ // código 
			$this->Nombre=(string)$nombre;
		}
		
		public  static function get_estacionados($ruta)
		{
			$archivo=fopen($ruta, "r");
			$arrayDatos = array();
			$retorno = array();

			while(!feof($archivo))
			{			
				$renglon=fgets($archivo);
				$arrayDatos = explode(",",$renglon);
				#var_dump($arrayDatos);
				$auto=new Vehiculo($arrayDatos[0], $arrayDatos[1], $arrayDatos[2]);
				array_push($retorno, $auto);
			}
			fclose($archivo);
			return $retorno;
		}




	}

	
?>