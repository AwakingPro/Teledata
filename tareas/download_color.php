<?php

include("../db/db.php");


$id = $_GET['id'];
$color = $_GET['color'];
$sql = mysql_query("SELECT query FROM SIS_Querys WHERE id=$id");

$constate1 = " SELECT fono_cob.Rut,Persona.Nombre_Completo,fono_cob.formato_subtel FROM fono_cob,Persona WHERE fono_cob.Rut IN (";
$constate2 = ") AND fono_cob.color = $color AND fono_cob.Rut = Persona.Rut ";

while($row=mysql_fetch_array($sql))
     {
        $query=$row[0];
     }
$queryFinal = $constate1.$query.$constate2;

/* Performing SQL query */
$result = mysql_query($queryFinal) or die("Query failed : " . mysql_error());
   echo "Rut;Nombre;Numero Telefono;Anio Castigo;Deuda Total;Mejor Gestion;Fecha Mejor Gestion;Fecha Compromiso;Monto Compromiso;Observacion;Color;Cantidad LLamados";
   echo "\r\n"; 
   
while ($line = mysql_fetch_array($result, MYSQL_BOTH)) {
$txt=$line[0].";".$line[1].";".$line[2].";".$line[3].";".$line[4].";".$line[5].";".$line[6].";".$line[7].";".$line[8].";".$line[9].";".$line[10].";".$line[11].";".$line[12]."\r\n";
$fecha = date('Y-m-d');
$hora  = date("G:H:s");
$data = $fecha."_".$hora;
header('Content-type: application/txt');

header('Content-Disposition: attachment; filename='.$data.'.csv');

echo $txt;

}

mysql_close($link); 
?>