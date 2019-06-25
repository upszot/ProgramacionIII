<?php
require_once './clases/Pizza.php';
require_once './clases/Venta.php';
require_once './clases/Empleado.php';
require_once './clases/upload.php';

class Pizzeria
{

    public static function existePizza($lista, $sabor, $tipo)
    {
        $retorno=null;
        foreach ($lista as $objeto) {
            if ( $objeto->getSabor() == $sabor && $objeto->getTipo() == $tipo) 
            {                
                $retorno= $objeto;
                break;
            }
        }
        return $retorno;
    }


    public static function getExistePizzaKey($lista, $sabor, $tipo)
    {//recorre la lista y donde encuentra devuelve la posicion
        $retorno = null;
        foreach ($lista as $key => $objeto) {
            if ($objeto->getSabor() == $sabor && $objeto->getTipo() == $tipo) 
            {
                $retorno = $key;
                break;
            }
        }
        return $retorno;
    }

    public static function agregarPizza($sabor, $tipo, $cantidad, $precio)
    {        
        global $PATH_ARCHIVOS;
        $lista = self::LeerJSON("$PATH_ARCHIVOS/Pizza.txt", "Pizza");        
        $Pizza = self::existePizza($lista, $sabor, $tipo);
        
        if ($Pizza == null) {
            echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Esta Pizza NO se Encuentra,Se agregara <br> </font>";
            $id=Pizza::siguienteId($lista);
            $nuevoPizza = new Pizza($id, $sabor, $tipo, $cantidad, $precio);
            array_push($lista, $nuevoPizza);
        }
        else
        {// Ya existe el Pizza, incrementar la cantidad
            echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Esta Pizza ya se Encuentra, Se incrementa la cantidad <br> </font>";
            $Pizza->setCantidad($Pizza->getCantidad()+$cantidad);
        }
        self::guardarJSON($lista, "$PATH_ARCHIVOS/Pizza.txt", "Pizza");
    }


    public static function modificarPizza($_PUT)
    {
        global $PATH_ARCHIVOS;
        if (isset($_PUT)) {
            $sabor  = $_PUT["sabor"];
            $tipo = $_PUT["tipo"];
            $cantidad = $_PUT["cantidad"];
            $precio = $_PUT["precio"];

            $lista = self::LeerJSON("$PATH_ARCHIVOS/Pizza.txt", "Pizza");
            $Pizza = self::existePizza($lista, $sabor, $tipo);
            if ($Pizza == null) {
                echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Esta Pizza NO se Encuentra,Se agregara <br> </font>";
                $id=Pizza::siguienteId($lista);
                $nuevoPizza = new Pizza($id, $sabor, $tipo, $cantidad, $precio);
                array_push($lista, $nuevoPizza);
            }
            else
            {// Ya existe el Pizza, incrementar la cantidad
                echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Esta Pizza ya se Encuentra, Se incrementa la cantidad y modificara el precio<br> </font>";
                $Pizza->setCantidad($Pizza->getCantidad()+$cantidad);
                $Pizza->setPrecio($precio);
            }
            
            self::guardarJSON($lista, "$PATH_ARCHIVOS/Pizza.txt", "Pizza");
        }
    }


    public static function borrarPizza($_DELETE)
    {
        global $PATH_ARCHIVOS;
        if (isset($_DELETE)) {
            $sabor  = $_DELETE["sabor"];
            $tipo = $_DELETE["tipo"];

            $lista = self::LeerJSON("$PATH_ARCHIVOS/Pizza.txt", "Pizza");
            $key = (self::getExistePizzaKey($lista, $sabor, $tipo));

            if ($key != null) 
            {// Elimina
                echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Se encontro la Pizza, Se eliminara<br> </font>";
                unset($lista[$key]);

                //moviendo la foto al backup
                $archivoOriginal=$sabor ."_". $tipo . ".png";
                $destino = "./fotosPizzas/".$archivoOriginal;                
                $arrayDeDatos = explode('.', $archivoOriginal);
                $nuevoDestino = "./backupFotos/" . $arrayDeDatos[0] . "_". date("Ymd_His") . ".$arrayDeDatos[1]"; 
                
                echo "NUEVO DESTINO $nuevoDestino";            
                copy($destino, $nuevoDestino); //movemos ese archivo al nuevo destino
            
                unlink ($destino);                
            }
            else
            {
                echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>NO Se encontro la Pizza a eliminar<br> </font>";
            }            
            self::guardarJSON($lista, "$PATH_ARCHIVOS/Pizza.txt", "Pizza");
        }
    }

    public static function agregarPizzaFoto($sabor, $tipo, $cantidad, $precio, $foto)
    {
        global $PATH_ARCHIVOS;
        $lista = self::LeerJSON("$PATH_ARCHIVOS/Pizza.txt", "Pizza");
        $Pizza = self::existePizza($lista, $sabor, $tipo);

        if ($Pizza == null) {
            $id=Pizza::siguienteId($lista);
            $nuevoPizza = new Pizza($id,$sabor, $tipo, $cantidad, $precio);            
            array_push($lista, $nuevoPizza);
        } else {
            $Pizza->setCantidad($Pizza->getCantidad() + $cantidad);
            echo "la nueva cantidad de Pizza es " . $Pizza->getCantidad();
        }

        Upload::cargarImagenPorNombre($foto, ($sabor ."_" . $tipo), "./fotosPizzas/");
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
                //echo "encontro el objeto";
                break;
            }
        }
        return $retorno;
    }

    public static function ExisteEmpleado($lista,$alias)
    {
        $retorno=null;
        foreach ($lista as $objeto) 
        {
            if ($objeto->getAlias() == $alias) 
            {
                $retorno= $objeto;
                break;
            }
        }
        return $retorno;
    }

    public static function AltaEmpleado($alias, $tipo, $edad, $email, $foto)
    {
        global $PATH_ARCHIVOS;

        $lista = self::LeerJSON("$PATH_ARCHIVOS/Empleado.txt", "Empleado");
        $Empleado=self::ExisteEmpleado($lista, $alias);

        if($Empleado!=null)
        {
            echo "<br>El Empleado ya existe<br>";
        }
        else
        {         
            $Nomfoto = "SIN_FOTO"; 
            if ($foto != null) {                
                $Nomfoto=$alias."_".$email;
                Upload::cargarImagenPorNombre($foto, $Nomfoto, "./fotosEmpleado/");
            }

            $Empleado=new Empleado($alias ,$tipo, $email , $edad, $Nomfoto);
            array_push($lista, $Empleado);
            self::guardarJSON($lista, "$PATH_ARCHIVOS/Empleado.txt", "Empleado");
        }
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
            /*  if ($Pizza->getCantidad() == 0) {
                $key = (self::getExistePizzaKey($listaPizzas, $sabor, $tipo));
                unset($listaPizzas[$key]);
            } */

            //echo "<br>valor de email: $email<br>";

            if ($foto != null) {
                $usuario=Generales::getUsuarioMail($email);
                $Nomfoto="Venta_".$tipo."_".$sabor."_".$usuario."_" . date("Ymd_His");
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


    public static function ListarPizzas($tipo)
    {
        $path_Borrado="./backupFotos/";
        $path_cargadas="./fotosPizzas/";

        switch ($tipo)
        {
           case "borrado":
                $path=$path_Borrado;
                break;            
            case "cargadas":
                $path=$path_cargadas;
                break;                
        }
        
        $arrayImagenes = scandir($path);
        //var_dump($arrayImagenes); 
        foreach ($arrayImagenes  as $file) 
        {
            if ($file != "." && $file != "..") 
            {
                if (file_exists($path.$file)) 
                {
                    $strHtml = "<img src=".$path. $file . " alt=" . " border=3 height=120px width=160px></img>";
                    echo $strHtml;
                }
            }
        }//FIN foreach ($arrayImagenes  as $file) 
    }


    public static function ListarEmpleados($tipo)
    {
        global $PATH_ARCHIVOS;
        $lista=self::LeerJSON("$PATH_ARCHIVOS/Empleado.txt", "Empleado");

        $strHtml=self::crearTablaHeader($lista);
 
        if($tipo == "foto" || $tipo == "sinfoto" || $tipo =="nombre")
        {

            foreach ($lista as $objeto) 
            {
                //mostrar venta...
                $strHtml.= "<tr>";
                $strHtml.= "<td>".$objeto->getAlias()."</td>";
                if($tipo!="nombre")
                {
                    $strHtml.= "<td>".$objeto->getTipo()."</td>";
                    $strHtml.= "<td>".$objeto->getEdad()."</td>";
                    $strHtml.= "<td>".$objeto->getemail()."</td>";
                    if($tipo=="foto")
                    {
                        $img="./fotosEmpleado/".$objeto->getNomfoto().".png";
                        $strHtml.= "<td><img src=" . $img . " alt=" . " border=3 height=30% width=30%></img></td>";
                    }
                    else
                    {// Buscar imagen que diga No Disponible
                        $strHtml.= "<td> SIN FOTO</td>";
                    }

                }
                
            } // fin foreach
            $strHtml.="</tbody>";
            $strHtml.="</table>";
            echo $strHtml;
        }//if
        else
        {
            echo "No hay opcion para eso";
        }
    }
        
    public static function crearTablaHeader($lista)
    {
        $strHtml="<table border='1'>";
        $strCabeceras = reset($lista);
        $strHtml.="<th>ALIAS</th>";
        $strHtml.="<th>TIPO</th>";
        $strHtml.="<th>EDAD</th>";
        $strHtml.="<th>EMAIL</th>";
        $strHtml.="<th>FOTO</th>";
        $strHtml.="<tbody>";
        
        return $strHtml;        
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
                            if (isset($objeto)) 
                            {
                                $Pizza = new Pizza($objeto->id, $objeto->sabor, $objeto->tipo,  $objeto->cantidad, $objeto->precio);
                                array_push($listado, $Pizza);
                            }
                            break;                        
                        case 'Venta':
                            $venta = new Venta($objeto->sabor ,$objeto->tipo, $objeto->email , $objeto->cantidad, $objeto->Nomfoto);                            
                            array_push($listado, $venta);             
                            break;
                        case 'Empleado':
                            $Empleado = new Empleado($objeto->alias ,$objeto->tipo, $objeto->email , $objeto->edad, $objeto->Nomfoto);                            
                            array_push($listado, $Empleado);             
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
                case 'Empleado':
                        $array = array('alias' => $key->getAlias(), 'tipo' => $key->getTipo(),'email' => $key->getemail(), 'edad' => $key->getEdad(),'Nomfoto' => $key->getNomfoto() );
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);
                    
                    break;                    
            }
        }

        fclose($archivo);
        return $listado;
    }

}// FIN CLASSE PIZZERIA

?>
