<?php
include("conect.php");
$q = "SELECT * FROM mensajes WHERE status = 1";
$res = mysql_query($q) or die (mysql_error());
$contar = mysql_num_rows($res);
if($contar>0)
{
	echo "1";
}
else
{
	echo "2";
}

?>