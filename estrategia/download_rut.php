<?php

include("../db/db.php");

$id = $_GET['id'];
$sql = mysql_query("SELECT query FROM SIS_Querys_Estrategias WHERE id=$id");

while($row=mysql_fetch_array($sql))
{
    $query=$row[0];
}

/* Performing SQL query */
$result = mysql_query($query) or die("Query failed : " . mysql_error());
   echo "Rut";
   echo "\r\n"; 
   
while ($line = mysql_fetch_array($result, MYSQL_BOTH)) {
$txt=$line[0]."\r\n";
$fecha = date('Y-m-d');
$hora  = date("G:H:s");
$data = $fecha."_".$hora;
header('Content-type: application/txt');

header('Content-Disposition: attachment; filename='.$data.'.csv');

echo $txt;

}

mysql_close($link); 
?>