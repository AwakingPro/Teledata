<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);
$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];
$accion=$_POST['accion'];
$periodo=$_POST['periodo'];
echo "<tr><td>Menor a 100M</td><td><center>$fecha1</center></td><td><center>$fecha2</center></td><td><center>$accion</center></td><td><center>$periodo</center></td></tr>";                            
?>