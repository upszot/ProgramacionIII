<?php
require_once './clases/Pizza.php';
require_once './clases/Venta.php';
require_once './clases/upload.php';

class Pizzeria
{
    public static function agregarPizza($sabor, $tipo, $cantidad, $precio)
    {        
        global $PATH_ARCHIVOS;
        $lista = self::LeerJSON("$PATH_ARCHIVOS/Pizza.txt", "Pizza");

        $id=Pizza::siguienteId($lista);

        //$Pizza = self::existePizza($lista, $sabor, $tipo);

        //if ($Pizza == null) {
            echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Esta Pizza NO se Encuentra,Se agregara <br> </font>";
            $nuevoPizza = new Pizza($id, $sabor, $tipo, $cantidad, $precio);
            array_push($lista, $nuevoPizza);
        //}
/*         else
        {// Ya existe el Pizza, incrementar la cantidad
            echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Esta Pizza ya se Encuentra, Se incrementa la cantidad <br> </font>";
            $Pizza->setCantidad($Pizza->getCantidad()+$cantidad);
        } */
        self::guardarJSON($lista, "$PATH_ARCHIVOS/Pizza.txt", "Pizza");
    }


    public static function hayStok($lista, $sabor, $tipo, $cantidad)
    {
        $retorno=null;
        foreach ($lista as $objeto) 
        {
            if ($objeto->getSabor() == $sabor && $objeto->getTipo() == $tipo && $objeto->getCantidad() >= $cantidad) 
            {
                $retorno= $objeto;
                echo "encontro el objeto";
                break;
            }
        }
        return $retorno;
    }
    
    
    public static function AltaVenta($sabor, $tipo, $cantidad, $email, $foto)
    {
        global $PATH_ARCHIVOS;

        $listaPizzas = self::LeerJSON("$PATH_ARCHIVOS/Pizza.txt", "Pizza");
        $Pizza=self::hayStok($listaPizzas, $sabor, $tipo, $cantidad);

        if($Pizza!=null)
        {
            //echo "<br>hay Pizza<br>";
            $Pizza->setCantidad($Pizza->getCantidad()-$cantidad);
            $listaVentas=self::LeerJSON("$PATH_ARCHIVOS/Venta.txt", "Venta");

            $Nomfoto = "SIN_FOTO";            
/*             if ($Pizza->getCantidad() == 0) {
                $key = (self::getExistePizzaKey($listaPizzas, $sabor, $tipo));
                unset($listaPizzas[$key]);
            } */

            if ($foto != null) {
                $NomfotoPizza="Venta_$email"."_" . date("Ymd_His");
                Upload::cargarImagenPorNombre($foto, $Nomfoto, "./fotosVentas/");
            }

            $venta=new Venta($Pizza->getSabor() ,$Pizza->getTipo(), $email , $cantidad, $Nomfoto);
            array_push($listaVentas, $venta);
            self::guardarJSON($listaVentas, "$PATH_ARCHIVOS/Venta.txt", "Venta");
            self::guardarJSON($listaPizzas, "$PATH_ARCHIVOS/Pizza.txt", "Pizza");
        }
    }

    public static function BuscaSaborTipo($sabor, $tipo)
    {
        global $PATH_ARCHIVOS;
        $Flag=0;
        $lista = self::LeerJSON("$PATH_ARCHIVOS/Pizza.txt", "Pizza");
        foreach ($lista as $objeto) {
            if ($objeto->getSabor() == $sabor) 
            {                
                if($objeto->getTipo() == $tipo)
                {//existe sabor y tipo
                    $Flag=1;
                }
                else
                {//existe solo el sabor buscado
                    $Flag=2;
                }
                break;
            }
            
        }
        self::sms(2,$Flag,$tipo);
        return $Flag;
    }


    public static function sms($punto,$cod,$tipo)
    {
        $sms;
        switch($punto)
        {
            case 1:
                break;
            case 2: //Consultar
                switch($cod)
                {
                    case  0:
                        $sms='NO existe el sabor buscado';
                        break;
                    case 1:
                        $sms='Existe el sabor y tipo';
                        break;
                    case 2:
                        $sms='existe sabor y pero no el tipo' ;
                        break;                  
                }
                break;
            }
            echo "<font size='3' color='black'  face='verdana' style='font-weight:bold' <br>$sms<br> </font>";
    }
// ********** ARCHIVOS  ************
    public static function LeerJSON($nombreArchivo, $tipo)
    {
        $ruta = $nombreArchivo;

        if (file_exists($ruta)) {

            $archivo = fopen($ruta, "r");
            $listado = array();
            while (!feof($archivo)) {
                $renglon = fgets($archivo);
                if ($renglon != "") {
                    $objeto = json_decode($renglon);
                    switch ($tipo) {
                        case 'Pizza':
                            if (isset($objeto)) {
                                $Pizza = new Pizza($objeto->id, $objeto->sabor, $objeto->tipo,  $objeto->cantidad, $objeto->precio);
                                array_push($listado, $Pizza);
                            }
                            break;                        
                        case 'Venta':
                            $venta = new Venta($objeto->sabor ,$objeto->tipo, $objeto->email , $objeto->cantidad, $objeto->Nomfoto);
                            
                            var_dump($venta);
                            array_push($listado, $venta);             
                            break;
                    }
                }
            }
            fclose($archivo);
            if (count($listado) > 0) {
                
                return $listado;
            }
        }
        return null;
    }


    public static function guardarJSON($lista, $nombreArchivo, $tipo) 
    {
        $listado = $lista;
        $archivo = fopen($nombreArchivo, "w");

        foreach($listado as $key) 
        {
            switch ($tipo) 
            {
                case 'Pizza':
                    if (!($key->getId() == '' || $key->getId() == '\n')) {
                        $array = array('id' => $key->getId(), 'sabor' => $key->getSabor(), 'tipo' => $key->getTipo(), 'cantidad' => $key->getCantidad() , 'precio' => $key->getPrecio());
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);
                    }
                    break;
                case 'Venta':
                    if (!($key->getSabor() == '' || $key->getSabor() == '\n')) {
                        $array = array('sabor' => $key->getSabor(), 'tipo' => $key->getTipo(),'email' => $key->getemail(), 'cantidad' => $key->getCantidad(),'Nomfoto' => $key->getNomfoto() );
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);
                    }
                    break;
            }
        }

        fclose($archivo);
        return $listado;
    }

}// FIN CLASSE PIZZERIA

?>
