<?php

class Empleado
{


    private $NomFoto;
    private $email;
    private $alias;
    private $tipo;
    private $edad;


    //Constructores
    function __construct($Palias ,$Ptipo, $Pemail , $Pedad, $PNomFoto)
    {
        $this->alias = $Palias;
        $this->tipo = $Ptipo;
        $this->email = $Pemail;
        $this->edad = $Pedad;
        $this->NomFoto = $PNomFoto;
    }

    //GETTER && SETTERS
    public function getAlias()
    {
        return $this->alias;
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
    public function getEdad()
    {
        return $this->edad;
    }
    public function getNomFoto()
    {
        return $this->NomFoto;
    }


    public function setAlias($var)
    {
        $this->alias = $var;
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
    public function setEdad($var)
    {
        $this->edad = $var;
    }
    public function setNomFoto($var)
    {
        $this->NomFoto=$var;
    }

    //funciones
    public function Mostrar()
    {
        echo "email: $this->email || alias: $this->alias || tipo: $this->tipo || edad: $this->edad";
    }

    public  function toArray()
    {
        $arrayAux = array();
        array_push($arrayAux, $this->email);
        array_push($arrayAux, $this->alias);
        array_push($arrayAux, $this->tipo);
        array_push($arrayAux, $this->edad);
        array_push($arrayAux, $this->NomFoto);
        array_push($arrayAux, "\n");

        return $arrayAux;
    }



}

?>
