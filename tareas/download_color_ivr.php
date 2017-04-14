<?php

/* Connecting, selecting database */
include("../db/db.php");


$id = $_GET['id'];
$color = $_GET['color'];
$sql = mysql_query("SELECT query FROM SIS_Querys WHERE id=$id");

$constate1 = " SELECT fono_cob.Rut,CONCAT(Persona.Nombres, ' ', Persona.Apellido_Paterno , ' ', Persona.Apellido_Materno),fono_cob.formato_subtel,Deuda.Ano_Deuda,Deuda.Monto_Mora,Mejor_Gestion.Respuesta_N1,Mejor_Gestion.Fecha_Gestion,Mejor_Gestion.Fec_Compromiso,Mejor_Gestion.Monto_Compromiso,Mejor_Gestion.Observacion,fono_cob.color_ivr,fono_cob.cantidad_llamados FROM fono_cob,Persona,Deuda,Mejor_Gestion WHERE fono_cob.Rut IN (";
$constate2 = ") AND fono_cob.color_ivr = $color AND fono_cob.Rut = Persona.Rut AND fono_cob.Rut = Deuda.Rut AND fono_cob.Rut = Mejor_Gestion.Rut GROUP BY fono_cob.formato_subtel ORDER BY fono_cob.Rut , fono_cob.color_ivr ASC";

while($row=mysql_fetch_array($sql))
     {
        $query=$row[0];
     }
$queryFinal = $constate1.$query.$constate2;

/* Performing SQL query */
$result = mysql_query($queryFinal) or die("Query failed : " . mysql_error());
   echo "Rut;Nombre;Numero Telefono;Anio Castigo;Deuda Total;Mejor Gestion;Fecha Mejor Gestion;Fecha Compromiso;Monto Compromiso;Observacion;Color IVR;Cantidad LLamados";
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