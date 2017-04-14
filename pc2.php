<?php
$conexion = mysql_connect("172.16.77.3" , "root" , "s9q7l5.,777");
mysql_select_db("foco",$conexion);
$nombre = 'Luis Ponce';
$q1 = mysql_query("SELECT script FROM Script");
while($r = mysql_fetch_array($q1))
{
     $text = $r['0'];
     $resultado = str_replace("{name}", $nombre, $text);
} 
echo $resultado;



?>