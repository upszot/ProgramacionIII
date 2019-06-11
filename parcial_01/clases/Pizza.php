<?php

class Pizza
{
    private $id;
    private $sabor;
    private $tipo; //“molde” o “piedra”
    private $cantidad;
    private $precio;


    //Constructores
    function __construct($id, $sabor, $tipo, $cantidad, $precio)
    {
        echo "<br> TIPO:  $tipo <br>";
        if($tipo== 'molde' || $tipo== 'piedra')
        {
            $this->id = $id;
            $this->tipo = $tipo;
            $this->sabor = $sabor;
            $this->precio = $precio;
            $this->cantidad = $cantidad;
        }
        else
        {
            echo "<br> ERROR - SOLO SE PUEDEN CARGAR PIZZAS DE MOLDE O DE PIEDRA";
        }
    }



    //GETTER && SETTERS
    public function getId()
    {
        return $this->id;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function getSabor()
    {
        return $this->sabor;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setId($var)
    {
        $this->id = trim($var);
    }
    public function setTipo($var)
    {
        $this->tipo = trim($var);
    }
    public function setSabor($var)
    {
        $this->sabor = trim($var);
    }
    public function setPrecio($var)
    {
        $this->precio = trim($var);
    }
    public function setCantidad($var)
    {
        $this->cantidad = trim($var);
    }



    //Funciones
    public function Mostrar()
    {
        echo "id: $this->id || sabor: $this->sabor || tipo: $this->tipo || cantidad: $this->cantidad || precio: $this->precio";
    }

    public  function toArray()
    {
        $arrayAux = array();
        array_push($arrayAux, $this->id);
        array_push($arrayAux, $this->sabor);
        array_push($arrayAux, $this->tipo);
        array_push($arrayAux, $this->cantidad);
        array_push($arrayAux, $this->precio);
        array_push($arrayAux, "\n");

        return $arrayAux;
    }


	public static function siguienteId($array)
	{
		$proximoId = 0;
		if (isset($array))
		{
			foreach ($array as $objetc)
			{
				if ($objetc->id > $proximoId)
				{
					$proximoId = $objetc->id;
				}
			}
		}
		return $proximoId + 1;
    }
    
}