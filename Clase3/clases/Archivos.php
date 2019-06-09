<?php 

    public  static function leer_archivo($ruta, $tipo)
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
        
?>