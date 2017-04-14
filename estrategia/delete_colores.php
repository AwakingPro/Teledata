<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);
$id=$_GET['id'];
mysql_query("DELETE FROM SIS_Colores  WHERE  id=$id");
header('Location: crear_categoria.php');
?>
