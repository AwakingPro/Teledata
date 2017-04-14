<?php
require_once('clases/conect.php');
set_time_limit(0); //Establece el número de segundos que se permite la ejecución de un script.
$fecha_ac = isset($_POST['timestamp']) ? $_POST['timestamp']:0;

$fecha_bd = $row['timestamp'];

while( $fecha_bd <= $fecha_ac )
	{	
		$query3    = "SELECT timestamp FROM mensajes ORDER BY timestamp DESC LIMIT 1";
		$con       = mysql_query($query3 );
		$ro        = mysql_fetch_array($con);
		
		usleep(100000);//anteriormente 10000
		clearstatcache();
		$fecha_bd  = strtotime($ro['timestamp']);
	}

$query       = "SELECT * FROM mensajes ORDER BY timestamp DESC LIMIT 1";
$datos_query = mysql_query($query);
while($row = mysql_fetch_array($datos_query))
{
	$ar["timestamp"]          = strtotime($row['timestamp']);	
	$ar["mensaje"] 	 		  = $row['mensaje'];	
	$ar["id"] 		          = $row['id'];	
	$ar["status"]           = $row['status'];	
	$ar["tipo"]           = $row['tipo'];	
}
$dato_json   = json_encode($ar);
echo $dato_json;
?>