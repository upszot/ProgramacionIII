<?php 

class conteiner
{	
	private $_id;
	private $_tamanio;
	private $_capacidad;
	private $_arrayProductos;

	public function __construct() 
	{ // código 
		$this->_id=1;
		$this->_tamanio=100;
		$this->_capacidad=10;
		$this->_listadoProductos= array();
	}

	public function agregarProducto($producto)
	{
		foreach ($this->_listadoProductos as $value) 
		{
			if($this->_capacidad <= $this->_tamanio+$producto->_kilos)
			{// si hay lugar en el conteiner agrego el producto
				$this->_tamanio+=$producto->_kilos;				
			}
		
		}	

	}


	public function mostrar()
	{
		//echo "ID: ".$this->_id;
		echo "<br> ID: $this->_id <br> TAMAÑO: $this->_tamanio <br> CAPACIDAD: $this->_capacidad <br>";
	}
		
}






?>
