<?php

class Venta
{
    private $sabor;
    private $tipo;
    private $email;
    private $cantidad;
    private $NomFoto;


    //Constructores
    function __construct($Psabor ,$Ptipo, $Pemail , $Pcantidad, $PNomFoto)
    {
        $this->sabor = $Psabor;
        $this->tipo = $Ptipo;
        $this->email = $Pemail;
        $this->cantidad = $Pcantidad;
        $this->NomFoto = $PNomFoto;
    }

    //GETTER && SETTERS
    public function getSabor()
    {
        return $this->sabor;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function getemail()
    {
        return $this->email;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getcantidad()
    {
        return $this->cantidad;
    }
    public function getNomFoto()
    {
        return $this->NomFoto;
    }


    public function setSabor($var)
    {
        $this->sabor = $var;
    }
    public function setTipo($var)
    {
        $this->tipo = $var;
    }
    
    public function setemail($var)
    {
        $this->email = $var;
    }
    public function setPrecio($var)
    {
        $this->precio = $var;
    }
    public function setcantidad($var)
    {
        $this->cantidad = $var;
    }
    public function setNomFoto($var)
    {
        $this->NomFoto=$var;
    }

    //funciones
    public function Mostrar()
    {
        echo "email: $this->email || sabor: $this->sabor || tipo: $this->tipo || cantidad: $this->cantidad";
    }

    public  function toArray()
    {
        $arrayAux = array();
        array_push($arrayAux, $this->email);
        array_push($arrayAux, $this->sabor);
        array_push($arrayAux, $this->tipo);
        //array_push($arrayAux, $this->precio);
        array_push($arrayAux, $this->cantidad);
        array_push($arrayAux, $this->NomFoto);
        array_push($arrayAux, "\n");

        return $arrayAux;
    }



}

?>
