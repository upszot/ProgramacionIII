<?php

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br> DELETE: <br> </font>";
parse_str(file_get_contents('php://input'), $_DELETE);
$_DELETE['cantidad']=0;
$_DELETE['precio']=0;
Heladeria::modificarHelado($_DELETE);

?>