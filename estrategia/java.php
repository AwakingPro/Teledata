<?php

$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

$proce=mysql_query("SELECT * FROM SIS_Procesos ");
$count_pro = mysql_num_rows($proce);
if($count_pro>0)
{
	header('Location: categoria_fonos.php?mensaje=2');
}
else
{
	$salida = shell_exec('java -jar Fonos.jar > /dev/null 2>&1 &');
	$ran = rand(1000, 3000);
	$proceso= "INSERT INTO SIS_Procesos(numero) VALUES ('$ran')";
	mysql_query($proceso);
	header('Location: categoria_fonos.php?mensaje=1');
}


?>
