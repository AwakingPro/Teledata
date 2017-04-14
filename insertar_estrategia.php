<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

$nombre_estrategia=$_POST['nombre_estrategia'];
$tipo=$_POST['tipo_estrategia'];
$comentario_estrategia=$_POST['comentario_estrategia'];
$fecha=date('Y-m-d');
$hora=date('H:i:s');
$usuario='Luis Ponce';


$query=mysql_query("INSERT INTO SIS_Estrategias(nombre,comentario,fecha,hora,usuario,tipo) VALUES('$nombre_estrategia','$comentario_estrategia','$fecha','$hora','$usuario','$tipo')");
$query1=mysql_query("SELECT id FROM SIS_Estrategias WHERE nombre='$nombre_estrategia'");
while($row=mysql_fetch_array($query1)){
	$id_estrategia=$row['id'];

}
echo "<input type='hidden' value='$id_estrategia' id='id_estrategia' name='id_estrategia'>";
?>