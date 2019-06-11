<?php
require_once './clases/Pizza.php';


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
            echo "<br> lista: <br>";
            var_dump($lista);
        //}
/*         else
        {// Ya existe el Pizza, incrementar la cantidad
            echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Esta Pizza ya se Encuentra, Se incrementa la cantidad <br> </font>";
            $Pizza->setCantidad($Pizza->getCantidad()+$cantidad);
        } */
        self::guardarJSON($lista, "$PATH_ARCHIVOS/Pizza.txt", "Pizza");
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
                        $sms='NO tenemos ese sabor';
                        break;
                    case 1:
                        $sms='Existe el tipo y sabor';
                        break;
                    case 2:
                    //$sms='Existe sabor buscado pero solo tenemos de ' . self::getTipoContrario($tipo);
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
/*                         case 'venta':
                            $venta=new Venta($objeto->sabor ,$objeto->tipo, $objeto->cliente , $objeto->precio, $objeto->cantidadKg, $objeto->NomfotoPizza);
                            array_push($listado, $venta);
                            break; */
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
/*                 case 'venta':
                    if (!($key->getSabor() == '' || $key->getSabor() == '\n')) {
                        $array = array('sabor' => $key->getSabor(), 'tipo' => $key->getTipo(),'cliente' => $key->getCliente(), 'precio' => $key->getPrecio(), 'cantidadKg' => $key->getcantidadKg(),'NomfotoHelado' => $key->getNomfotoHelado() );
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);
                    }
                    break; */
            }
        }

        fclose($archivo);
        return $listado;
    }

}// FIN CLASSE PIZZERIA

?>
