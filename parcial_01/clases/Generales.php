<?php

class Generales
{

    /*
        $cadena donde se realiza la busqueda
        $separador = caracter separador de cadena
        $parte = 1 substring antes del separador
        $parte = 2  substring dewspues del separador
        $incluye = (true / false) si incluye o no el separador
    */
    public static function getSubcadena($cadena,$separador,$parte,$incluye)
    {
        $pos=strpos($cadena,$separador,0);

        switch($parte)
        {
        case 1:
            if($incluye)
            {
            $pos=$pos+1;
            }      
            $retorno=substr($cadena,0,$pos);
            break;
        case 2:
            if(!$incluye)
            {
            $pos=$pos+1;
            }      
            $retorno=substr($cadena,$pos);
            break;
        }
    return $retorno;

    }

    public static function getUsuarioMail($mail)
    {
        //$pos=strpos($mail,"@",0);// Posicion donde se encontro @
        //$retorno=substr($mail,0,$pos); //substring de 0 a la posicion

        $retorno = explode ('@', $mail);

        return $retorno[0];
    }

}
?>