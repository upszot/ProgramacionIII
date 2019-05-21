<?php
//OBTENGO TODOS LOS NOMBRES DE LOS ARCHIVOS
$nombres = $_FILES["archivo"]["name"];

//OBTENGO TODOS LOS TAMAÑOS DE LOS ARCHIVOS
$sizes = $_FILES["archivo"]["name"];

//INDICO CUALES SERAN LOS DESTINOS DE LOS ARCHIVOS SUBIDOS Y SUS TIPOS
$destinos = array();
$tiposArchivo = array();
foreach($nombres as $nombre){
	$destino = "archivos/" . $nombre;
	array_push($destinos, $destino);
	array_push($tiposArchivo, pathinfo($destino, PATHINFO_EXTENSION));
}

$uploadOk = TRUE;

//VERIFICO QUE LOS ARCHIVOS NO EXISTAN
foreach($destinos as $destino){
	if (file_exists($destino)) {
		echo "El archivo {$destino} ya existe. Verifique!!!";
		$uploadOk = FALSE;
		break;
	}
}
	
//VERIFICO LOS TAMAÑOS MAXIMOS QUE PERMITO SUBIR
foreach($sizes as $size){
	if ($size > 500000) {
		echo "Archivo demasiado grande. Verifique!!!";
		$uploadOk = FALSE;
		break;
	}
}

//VERIFICO SI ES UNA IMAGEN O NO

//OBTIENE EL TAMAÑO DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
//IMAGEN, RETORNA FALSE
$tmpsNames = $_FILES["archivo"]["tmp_name"];
$i=0;
foreach($tmpsNames as $tmpName){
	
	$esImagen = getimagesize($tmpName);

	if($esImagen === FALSE) {//NO ES UNA IMAGEN

		//SOLO PERMITO CIERTAS EXTENSIONES
		if($tiposArchivo[$i] != "doc" && $tiposArchivo[$i] != "txt" && $tiposArchivo[$i] != "rar") {
			echo "Solo son permitidos archivos con extension DOC, TXT o RAR.";
			$uploadOk = FALSE;
			break;
		}
	}
	else {// ES UNA IMAGEN

		//SOLO PERMITO CIERTAS EXTENSIONES
		if($tiposArchivo[$i] != "jpg" && $tiposArchivo[$i] != "jpeg" && $tiposArchivo[$i] != "gif"
			&& $tiposArchivo[$i] != "png") {
			echo "Solo son permitidas imagenes con extension JPG, JPEG, PNG o GIF.";
			$uploadOk = FALSE;
			break;
		}
	}
	$i++;
}

//VERIFICO SI HUBO ALGUN ERROR, CHEQUEANDO $uploadOk
if ($uploadOk === FALSE) {

    echo "<br/>NO SE PUDIERON SUBIR LOS ARCHIVOS.";

} else {
	//MUEVO LOS ARCHIVOS DEL TEMPORAL AL DESTINO FINAL
	for($i=0;$i<count($tmpsNames);$i++){
		if (move_uploaded_file($tmpsNames[$i], $destinos[$i])) {
			echo "<br/>El archivo ". basename( $tmpsNames[$i]). " ha sido subido exitosamente.";
		} else {
			echo "<br/>Lamentablemente ocurri&oacute; un error y no se pudo subir el archivo ". basename( $tmpsNames[$i]).".";
		}
	}
}

?>