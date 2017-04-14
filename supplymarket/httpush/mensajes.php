<?php
include("clases/conect.php");
$q = "SELECT * FROM mensajes";
echo $res = mysql_query($q) or die (mysql_error());
while($timi = mysql_fetch_array($res))
{
	echo "Mensaje: ".$timi['mensaje'];
	echo "<br>";
}
?>