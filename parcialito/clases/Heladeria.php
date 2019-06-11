<?php
require_once './clases/Helado.php';
require_once './clases/Venta.php';
require_once './clases/upload.php';

class Heladeria
{
    private $nombre;
    private $listaHelados;
    private $listaVentas;


    //Constructores
    function __construct($nom)
    {
        $this->nombre = $nom;
        $this->listaHelados = array();
        $this->listaVentas = array();
    }

    //Archivos
    public static function Leer($formato, $nombreArchivo, $tipo)
    {
        $listado = array();

        switch ($formato) {
            case "csv":
                $archivo = fopen($nombreArchivo, "r");
                break;
            case "txt":
                $archivo = fopen($nombreArchivo, "r");
                break;
        }
        while (!feof($archivo)) {
            $renglon = fgets($archivo);

            $arrayDeDatos = explode(',', $renglon);

            if (isset($arrayDeDatos)) {

                switch ($tipo) {
                    case 'helado':
                        $helado = new Helado($arrayDeDatos[0], $arrayDeDatos[1], $arrayDeDatos[2], $arrayDeDatos[3]);
                        array_push($listado, $helado);
                    case 'venta':
                        $venta=new Venta($arrayDeDatos[0],$arrayDeDatos[1],$arrayDeDatos[2],$arrayDeDatos[3],$arrayDeDatos[4],$arrayDeDatos[5]);
                        array_push($listado, $venta);
                }
            }
        }
        fclose($archivo);
        return $listado;
    }


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
                        case 'helado':
                            if (isset($objeto)) {
                                $helado = new Helado($objeto->sabor, $objeto->tipo,  $objeto->cantidad, $objeto->precio);
                                array_push($listado, $helado);
                            }
                            break;                        
                        case 'venta':
                            $venta=new Venta($objeto->sabor ,$objeto->tipo, $objeto->cliente , $objeto->precio, $objeto->cantidadKg, $objeto->NomfotoHelad);
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
    
    
    //funciones
    
    public static function agregarHelado($sabor, $tipo, $cantidad, $precio)
    {        
        global $PATH_ARCHIVOS;
        $lista = self::LeerJSON("$PATH_ARCHIVOS/helados.txt", "helado");
        $helado = self::existeHelado($lista, $sabor, $tipo);

        if ($helado == null) {
            echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Este helado NO se Encuentra en el Heladeria,Se agregara <br> </font>";
            $nuevoHelado = new Helado($sabor, $tipo, $cantidad, $precio);
            array_push($lista, $nuevoHelado);
        }
        else
        {// Ya existe el helado, incrementar la cantidad
            echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Este helado ya se Encuentra en el Heladeria, Se incrementa la cantidad <br> </font>";
            $helado->setCantidad($helado->getCantidad()+$cantidad);
        }
        self::guardarJsonHeladeria($lista, "$PATH_ARCHIVOS/helados.txt", "helado");
    }
    
    public static function existeHelado($lista, $sabor, $tipo)
    {
        $retorno=null;
        foreach ($lista as $helado) {
            if ($helado->getSabor() == $sabor && $helado->getTipo() == $tipo) {                
                $retorno= $helado;
                break;
            }
        }
        return $retorno;
    }

    public static function getTipoContrario($tipo)
    {
        switch($tipo)
        {
            case 'crema':
            $tipoContrario='agua';
            break;
            case 'agua':
            $tipoContrario='crema';
            break;
            default:
            $tipoContrario='tipo incorrecto';
        }
        return $tipoContrario;
    }
    
    public static function sms($punto,$cod,$tipo)
    {
        $sms;
        switch($punto)
        {
            case 1:
                break;
                case 2: //ConsultarHelado
                switch($cod)
                {
                    case  0:
                        $sms='NO tenemos ese sabor';
                        break;
                    case 1:
                        $sms='Existe el tipo y sabor';
                        break;
                    case 2:
                    $sms='Existe sabor buscado pero solo tenemos de ' . self::getTipoContrario($tipo);
                    break;
                }
                break;
            }
            echo "<font size='3' color='black'  face='verdana' style='font-weight:bold' <br>$sms<br> </font>";
    }

    public static function BuscaSaborTipoHelado($sabor, $tipo)
    {
        global $PATH_ARCHIVOS;
        $Flag=0;
        $lista = self::LeerJSON("$PATH_ARCHIVOS/helados.txt", "helado");
        foreach ($lista as $helado) {
            if ($helado->getSabor() == $sabor) 
            {                
                if($helado->getTipo() == $tipo)
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

    
    public static function guardarJsonHeladeria($lista, $nombreArchivo, $tipo) //SEGUIR ACA
    {
        $listado = $lista;
        $archivo = fopen($nombreArchivo, "w");

        echo '<pre>', var_dump($listado), '</pre>';

        foreach ($listado as $key) {
            switch ($tipo) {
                case 'helado':
                    if (!($key->getSabor() == '' || $key->getSabor() == '\n')) {
                        $array = array('sabor' => $key->getSabor(), 'tipo' => $key->getTipo(), 'precio' => $key->getPrecio(), 'cantidad' => $key->getCantidad());
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);
                    }
                    break;
                case 'venta':
                    if (!($key->getsabor() == '' || $key->getsabor() == '\n')) {
                        $array = array('sabor' => $key->getsabor(), 'tipo' => $key->gettipo(),'cliente' => $key->getCliente(), 'precio' => $key->getPrecio(), 'cantidadKg' => $key->getcantidadKg(),'NomfotoHelado' => $key->getNomfotoHelado() );
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);
                    }
                    break;
            }
        }

        fclose($archivo);
        return $listado;
    }



    public static function guardarEnHeladeria($lista, $nombreArchivo, $tipo)
    {
        $archivo = fopen($nombreArchivo, "w");

        echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Lista Guardada COMPLETA en csv o txt <br> </font>";

        foreach ($lista as $objeto) {

            switch ($tipo) {
                case 'helado':
                    if (!($objeto->getSabor() == '' || $objeto->getSabor() == '\n' || $objeto->getSabor() == ',')) {
                        $aux = implode(',', $objeto->toArray());
                        fputs($archivo,  $aux);
                    }
                    break;
                case 'venta':
                    if (!($objeto->getnombre() == '' || $objeto->getnombre() == '\n' || $objeto->getnombre() == ',')) {
                        $aux = implode(',', $objeto->toArray());
                        fputs($archivo,  $aux);
                    }
                    break;
            }
        }
        fclose($archivo);
        return $$lista;
    }



    public static function ListarTodo($tipo)
    {
        echo $tipo;
        global $PATH_ARCHIVOS;
        $lista = self::LeerJSON("$PATH_ARCHIVOS/$tipo.s.txt", $tipo);
        foreach ($lista as $objeto) {
            $objeto->Mostrar();
        }
    }


    public static function agregarHeladoConFoto($sabor, $tipo, $cantidad, $precio, $fotoHelado)
    {
        $lista = self::LeerJSON("./archivos/helados.txt", "helado");
        $helado = self::existeHelado($lista, $sabor, $tipo);

        if ($helado == null) {

            $nuevoHelado = new Helado($sabor, $tipo, $cantidad, $precio);

            echo "nombre archivo ($sabor.$tipo)";
            var_dump($fotoHelado);
            Upload::cargarImagenPorNombre($fotoHelado, ($sabor . $tipo));
            array_push($lista, $nuevoHelado);

            self::guardarJsonHeladeria($lista, "./archivos/helados.txt", "helado");
        }
    }

    public static function hayKilosHelado($lista, $sabor, $tipo, $cantidad)
    {
        $retorno=null;
        foreach ($lista as $helado) 
        {
            if ($helado->getSabor() == $sabor && $helado->getTipo() == $tipo && $helado->getCantidad() >= $cantidad) 
            {
                $retorno= $helado;
                echo "encontro el helado";
                break;
            }
        }
        return $retorno;
    }
    
    public static function CargarVector($tipoArchivo)
    {//TIPO=venta o helado
        global $PATH_ARCHIVOS;
        $lista = self::LeerJSON("$PATH_ARCHIVOS/$tipoArchivo.s.txt", $tipoArchivo);
        if ($lista == null) 
        {
            $lista = array();
        }
        return $lista;
    }
    
    public static function AltaVenta($sabor, $tipo, $cantidad, $cliente, $foto)
    {
        global $PATH_ARCHIVOS;
        //$listaHelados=self::CargarVector("helado");
        $listaHelados = self::LeerJSON("$PATH_ARCHIVOS/helados.txt", "helado");
        //var_dump( $listaHelados);
        $helado=self::hayKilosHelado($listaHelados, $sabor, $tipo, $cantidad);
        /* echo "sin entrar"; */

        if($helado!=null)
        {
            echo "<br>hay helado<br>";
            $helado->setCantidad($helado->getCantidad()-$cantidad);
            //$listaVentas=self::CargarVector("venta");
            $listaVentas=self::LeerJSON("$PATH_ARCHIVOS/ventas.txt", "venta");

            $NomfotoHelado=null;
            
            if ($helado->getCantidad() == 0) {
                $key = (self::getExisteHeladoKey($listaHelados, $sabor, $tipo));
                unset($listaHelados[$key]);
            }

            if ($foto != null) {
                $NomfotoHelado="venta_$cliente"."_" . date("Ymd_His");
                Upload::cargarImagenPorNombre($foto, $NomfotoHelado, "./fotosVentas/");
                echo "no tomo la imagen";
            }
            echo "<br>lista ventas -> antes de guardar <br>";
            var_dump($listaVentas);
            
            $venta=new Venta($helado->getSabor() ,$helado->getTipo(), $cliente , ($helado->getPrecio() * $cantidad) , $cantidad, $NomfotoHelado);
            array_push($listaVentas, $venta);
            echo "<br>ventas->  antes de guardar <br>";
            var_dump($listaVentas);

            self::guardarJsonHeladeria($listaVentas, "$PATH_ARCHIVOS/ventas.txt", "venta");
            self::guardarJsonHeladeria($listaHelados, "$PATH_ARCHIVOS/helados.txt", "helado");
        }
    }

    public static function getExisteHeladoKey($lista, $sabor, $tipo)
    {//recorre la lista y donde encuentra devuelve el id
        $retorno = null;
        foreach ($lista as $key => $helado) {
            if ($helado->getSabor() == $sabor && $helado->getTipo() == $tipo) {
                $retorno = $key;
                break;
            }
        }
        return $retorno;
    }

}//FIN DE LA CLASE