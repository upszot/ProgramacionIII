<?php

class Helado
{
    private $sabor;
    private $tipo;
    private $precio;
    private $cantidad;

    //Constructores
    function __construct($sabor, $tipo, $cantidad, $precio)
    {
        $this->tipo = $tipo;
        $this->sabor = $sabor;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }


    //GETTER && SETTERS
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
        echo "sabor: $this->sabor || tipo: $this->tipo || precio: $this->precio || cantidad: $this->cantidad";
    }

    public  function toArray()
    {
        $arrayAux = array();
        array_push($arrayAux, $this->sabor);
        array_push($arrayAux, $this->tipo);
        array_push($arrayAux, $this->precio);
        array_push($arrayAux, $this->cantidad);
        array_push($arrayAux, "\n");

        return $arrayAux;
    }


}