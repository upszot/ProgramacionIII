<?php 
require_once "producto.php";

class conteiner
{	
	private $_id;
	private $_tamanio;
	private $_capacidad;
	private $_listadoProductos;

	public function __construct($id) 
	{ // código 
		$this->_id=$id;
		$this->_tamanio=1;
		$this->_capacidad=1000;
		$this->_listadoProductos= array();
	}

	public function agregarProducto($producto)
	{		
			if( $this->_capacidad >= $this->_tamanio + $producto->getKilos() )
			{// si hay lugar en el conteiner agrego el producto		
				$this->_tamanio+=$producto->getKilos();				
				array_push($this->_listadoProductos,$producto);
	
			}//fin if	
	}


	public function mostrar()
	{
		echo "<br><br>CONTEINER: <br>";
		echo "<br> ID: $this->_id <br> TAMAÑO: $this->_tamanio <br> CAPACIDAD: $this->_capacidad <br>";
		echo "<br> Productos dentro del conteiner: <br>";
		foreach ($this->_listadoProductos as $value) 
		{			
			$value->mostrar();		
		}	
	}	

}






?>
