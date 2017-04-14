<?php
include("clases/conect.php");
$mensaje = "Hola";
$tipo = "1";

$timestamp = date("Y-m-d H:i:s");

$q = "INSERT INTO mensajes values ('','$mensaje','$timestamp','1','$tipo')";
$res = mysql_query($q) or die (mysql_error());
?>