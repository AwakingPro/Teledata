<?php
include("../db/db.php");
$nombre_estrategia=$_POST['nombre_estrategia'];
$tipo=$_POST['tipo_estrategia'];
$comentario_estrategia=$_POST['comentario_estrategia'];
$fecha=date('Y-m-d');
$hora=date('H:i:s');
$usuario='Luis Ponce';


$query=mysql_query("INSERT INTO SIS_Estrategias(nombre,comentario,fecha,hora,usuario,tipo) VALUES('$nombre_estrategia','$comentario_estrategia','$fecha','$hora','$usuario','$tipo')");
$query1=mysql_query("SELECT id FROM SIS_Estrategias WHERE nombre='$nombre_estrategia'");
while($row=mysql_fetch_array($query1))
{
	$id_estrategia=$row['id'];

}
$array = array('uno' => "<input type='hidden' value='$id_estrategia' id='id_estrategia' name='id_estrategia'>", 'dos' => "$id_estrategia");
echo json_encode($array);
?>