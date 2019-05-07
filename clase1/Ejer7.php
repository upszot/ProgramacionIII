<?php 

//Ejercicio7:
echo "</br></br><strong>$Ap7</strong></br>";

$Ap7='Aplicación No 7 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date​ ) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.';

/*$fecha=date();
echo "fecha= $fecha";
*/
echo date("Y")."<br>";
echo date("M-D-Y")."<br>";
echo date("d/m/y")."<br>";
echo date("d/m")."<br>"."<br>"."<br>";

if(date("m") >=1 && date("m") <=3 ) 
{
	print("verano");
}
if(date("m") >=4 && date("m") <=6 ) 
{
	
	print("otoño");
}
if(date("m") >=7 && date("m") <=8 ) 
{
    print("invierno");
}
if(date("m") >=9 && date("m") <=12 ) 
{
	print("primavera");
}

?>