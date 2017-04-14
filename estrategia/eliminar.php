<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

$id=$_POST['id'];
mysql_query("DELETE FROM SIS_Querys WHERE   id=$id")

?>