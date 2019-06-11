<?php
/**
 * 
 */
class ManejadorDeArchivos
{
	
	function __construct()
	{
		date_default_timezone_set("America/Argentina/Buenos_Aires");
	}


	public  static function backupArchivo($Origen)
	{
		copy($Origen,"backup/".pathinfo($Origen,PATHINFO_FILENAME)."_".date("ymhi").".".pathinfo($Origen,PATHINFO_EXTENSION));
	}

	public static function moverArchivoBackup($archivoOriginal , $nuevoArchivo, $destino)
	{
		$arrayDeDatos = explode('.', $archivoOriginal); //agarramos el archivo original y lo desarmamos
		$nuevoDestino = "./backup/" . $nuevoArchivo.date("Ymd_hms").".$arrayDeDatos[1]"; //hacemos un nuevo destino url con el nuevo nombre de archivo y la extension del original
		
		echo "NUEVO DESTINO $nuevoDestino";
		copy($destino, $nuevoDestino ); //movemos ese archivo al nuevo destino

		$destino ="./archivos/".$nuevoArchivo.".$arrayDeDatos[1]";

		return TRUE;
	}

	public static function agregarMarcaDeAgua($archivo, $marcaAgua)
	{
		$im = imagecreatefrompng($archivo);
		$estampa = imagecreatefrompng($marcaAgua);


		// Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
		$margen_dcho = 10;
		$margen_inf = 10;
		$sx = imagesx($estampa);
		$sy = imagesy($estampa);

		// Copiar la imagen de la estampa sobre nuestra foto usando los índices de márgen y el
		// ancho de la foto para calcular la posición de la estampa. 
		imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));

		// Imprimir y liberar memoria
		//header('Content-type: image/png');
		imagepng($im,$archivo);
		//imagedestroy($im);

	}


}

?>