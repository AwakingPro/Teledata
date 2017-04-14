<?php

/* Connecting, selecting database */
$link = mysql_connect("190.215.48.149", "svergara", "svergara.2012")
    or die("Could not connect : " . mysql_error());
mysql_select_db("reporteria",$link) or die("Could not select database");

/* Connecting, selecting database */
$link2 = mysql_connect("localhost", "root", "M9a7r5s3A")
    or die("Could not connect : " . mysql_error());
mysql_select_db("foco",$link2) or die("Could not select database");

$query = mysql_query("SELECT * FROM gestion_ult_trimestre ",$link);
while($row = mysql_fetch_array($query))
{
	$rut = $row['rut_cliente'];
	mysql_query("INSERT IGNORE INTO Prueba (Rut) VALUES ('$rut')",$link2);
}

mysql_close($link); 
mysql_close($link2); 
?>