<?php

/* Connecting, selecting database */
$link = mysql_connect("localhost", "root", "M9a7r5s3A")
    or die("Could not connect : " . mysql_error());
mysql_select_db("foco") or die("Could not select database");

$id = $_GET['id'];
$sql = mysql_query("SELECT query FROM SIS_Querys WHERE id=$id");

$constate1 = " SELECT fono_cob.rut,Persona.Nombres,Persona.Apellido_Paterno,Persona.Apellido_Materno,fono_cob.numero_telefono,Deuda.Ano_Deuda,Deuda.Monto_Mora,Mejor_Gestion.Respuesta_N1,Mejor_Gestion.Fecha_Gestion,Mejor_Gestion.Fec_Compromiso,Mejor_Gestion.Monto_Compromiso,Mejor_Gestion.Observacion,fono_cob.color FROM fono_cob,Persona,Deuda,Mejor_Gestion WHERE fono_cob.rut IN (";
$constate2 = ") AND ( color = 1  OR color = 2) AND fono_cob.rut = Persona.Rut AND fono_cob.rut = Deuda.Rut AND fono_cob.rut = Mejor_Gestion.Rut ORDER BY fono_cob.rut , fono_cob.color ASC";

while($row=mysql_fetch_array($sql))
     {
        $query=$row[0];
     }
$queryFinal = $constate1.$query.$constate2;

/* Performing SQL query */
$result = mysql_query($queryFinal) or die("Query failed : " . mysql_error());
   echo "Rut;Nombres;Apellido Paterno;Apellido Materno;Numero Telefono;Anio Castigo;Deuda Total;Mejor Gestion;Fecha Mejor Gestion;Fecha Compromiso;Monto Compromiso;Observacion;Color";
   echo "\r\n"; 
   
while ($line = mysql_fetch_array($result, MYSQL_BOTH)) {
$txt=$line[0].";".$line[1].";".$line[2].";".$line[3].";".$line[4].";".$line[5].";".$line[6].";".$line[7].";".$line[8].";".$line[9].";".$line[10].";".$line[11].";".$line[12]."\r\n";

header('Content-type: application/txt');

header("Content-Disposition: attachment; filename=reporte_sti_1.txt");

echo $txt;

}

mysql_close($link); 
?>