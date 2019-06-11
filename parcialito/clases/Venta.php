<?php

class Venta
{
    private $cliente;
    private $sabor;
    private $tipo;
    private $precio;
    private $cantidadKg;
    private $NomfotoHelado;

    //Constructores
    function __construct($Psabor ,$Ptipo, $Pcliente , $Pprecio, $PcantidadKg, $PNomfotoHelado)
    {
        $this->sabor = $Psabor;
        $this->tipo = $Ptipo;
        $this->cliente = $Pcliente;
        $this->precio = $Pprecio;
        $this->cantidadKg = $PcantidadKg;
        $this->NomfotoHelado = $PNomfotoHelado;
    }

    //GETTER && SETTERS
    public function getsabor()
    {
        return $this->sabor;
    }
    public function gettipo()
    {
        return $this->tipo;
    }
    public function getCliente()
    {
        return $this->cliente;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getcantidadKg()
    {
        return $this->cantidadKg;
    }
    public function getNomfotoHelado()
    {
        return $this->NomfotoHelado;
    }


    public function setsabor($var)
    {
        $this->sabor = $var;
    }
    public function settipo($var)
    {
        $this->tipo = $var;
    }
    
    public function setCliente($var)
    {
        $this->cliente = $var;
    }
    public function setPrecio($var)
    {
        $this->precio = $var;
    }
    public function setcantidadKg($var)
    {
        $this->cantidadKg = $var;
    }
    public function setNomfotoHelado($var)
    {
        $this->NomfotoHelado=$var;
    }

    //funciones
    public function Mostrar()
    {
        echo "cliente: $this->cliente || sabor: $this->sabor || tipo: $this->tipo || precio: $this->precio || cantidad Kg: $this->cantidadKg";
    }

    public  function toArray()
    {
        $arrayAux = array();
        array_push($arrayAux, $this->cliente);
        array_push($arrayAux, $this->sabor);
        array_push($arrayAux, $this->tipo);
        array_push($arrayAux, $this->precio);
        array_push($arrayAux, $this->cantidadKg);
        array_push($arrayAux, $this->NomfotoHelado);
        array_push($arrayAux, "\n");

        return $arrayAux;
    }



}