<?php
//ejercicio 6
echo "</br></br><strong>$Ap6</strong></br>";

//$operador="+";
$operador=(string) $_GET["Oper"];
$op1=2;
$op2=3;

switch ($operador)
{
	case "+":
		echo "suma";
		$rta=$op1+$op2;
	break;
	case "-":
		echo "resta";
		$rta=$op1-$op2;
	break;	
	case "/":
		echo "division";
		if($op2===0)
			$rta=$op1/$op2;
		else
			echo "no se puede dividir por 0";
	break;
	case "*":
		echo "multiplicacion";
		$rta=$op1*$op2;
	break;		
}
echo "</br>RTA= $rta";
?>
