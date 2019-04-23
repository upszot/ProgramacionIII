<?php 

//Ejercicio5:
echo "</br></br><strong>$Ap5</strong></br>";

$a=1;
$b=2;
$c=3;
$valorMedio;
if(($a>$b)&&($a<$c))
{
	$valorMedio=$a;
}
if(($b>$a)&&($b<$c))
{
	$valorMedio=$b;
}
if(($c>$a)&&($c<$b))
{
	$valorMedio=$c;
}
echo "</br>Valor medio: $valorMedio";
?>