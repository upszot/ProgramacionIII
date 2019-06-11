<?php

require_once 'ManejadorDeArchivos.php';

class Upload
{

	public function cargarImagenPorNombre($nombreArchivo, $nombre, $carpetaDestino )
	{
		//INDICO CUAL SERA EL DESTINO DEL ARCHIVO SUBIDO
		$destino = $carpetaDestino . $nombreArchivo["name"];
		if (isset($nombre)) {
			$tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);
			$destino = $carpetaDestino . $nombre . ".$tipoArchivo";
		}

		$uploadOk = TRUE;
		$tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);

		//VERIFICO QUE EL ARCHIVO NO EXISTA
		if (file_exists($destino)) {
			$uploadOk = ManejadorDeArchivos::moverArchivoBackup($nombreArchivo["name"], $nombre, $destino);
		}
		//VERIFICO EL TAMA�O MAXIMO QUE PERMITO SUBIR
		if ($nombreArchivo["size"] > 5000000) {
			echo "El archivo es demasiado grande. Verifique!!!";
			$uploadOk = FALSE;
		}
		$esImagen = getimagesize($nombreArchivo["tmp_name"]);

		if ($esImagen === FALSE) { //NO ES UNA IMAGEN

			//SOLO PERMITO CIERTAS EXTENSIONES
			if ($tipoArchivo != "doc" && $tipoArchivo != "txt" && $tipoArchivo != "rar") {
				echo "Solo son permitidos archivos con extension DOC, TXT o RAR.";
				$uploadOk = FALSE;
			}
		} else { // ES UNA IMAGEN

			//SOLO PERMITO CIERTAS EXTENSIONES
			if (
				$tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif"
				&& $tipoArchivo != "png"
			) {
				echo "Solo son permitidas imagenes con extension JPG, JPEG, PNG o GIF.";
				$uploadOk = FALSE;
			}
		}

		//VERIFICO SI HUBO ALGUN ERROR, CHEQUEANDO $uploadOk
		if ($uploadOk === FALSE) {

			echo "<br/>NO SE PUDO SUBIR EL ARCHIVO.";
		} else {

			//MUEVO EL ARCHIVO DEL TEMPORAL AL DESTINO FINAL
			if (move_uploaded_file($nombreArchivo["tmp_name"], $destino))
			{
				ManejadorDeArchivos::agregarMarcaDeAgua($destino, "./firma.png");
				echo "<br/><h1>El archivo " . basename($nombreArchivo) . " ha sido subido exitosamente.</h1>";
			} 
			else {
				echo "<br/>Lamentablemente ocurri&oacute; un error y no se pudo subir el archivo.";
			}
		}
	}
}
