<?php 


class Vehiculo
{	
	private $patente;
	private $ingreso;
	private $importe;
	



	public function __construct($patente,$ingreso,$importe) 	
	{ // código 
		$this->patente=(string)$patente;
		$this->ingreso=(string)$ingreso;
		$this->importe=(string)$importe;
	}

	public static function leer($ruta)
	{		
		$archivo=fopen($ruta, "r");
		$arrayDatos = array();
		$retorno = array();

		while(!feof($archivo))
		{			
			#echo  "<br/> hola";
			$renglon=fgets($archivo);
			$arrayDatos = explode(",",$renglon);
			#var_dump($arrayDatos);
			$auto=new Vehiculo($arrayDatos[0], $arrayDatos[1], $arrayDatos[2]);
			array_push($retorno, $auto);

			echo "<br/>";
		}
		fclose($archivo);
		return $retorno;
	}

	public function mostrar()
	{
		#echo "Patente: this->$patente Ingreso: this->$ingreso Importe: this->importe";
		echo "$this->patente $this->ingreso $this->importe<br>";
	}
}

?>