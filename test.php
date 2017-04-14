<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);
$monto_2=24000000000;
echo $monto_2 = number_format($monto_2, 0, "", ".");


?>