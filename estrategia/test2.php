<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
$fecha = date('Y-m-d');
$hora  = date("G:H:s");
$data = $fecha."_".$hora;
header('Content-Disposition: attachment; filename='.$data.'.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Rut', 'Telefono'));

// fetch the data



// loop over the rows, outputting them
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

$id = $_GET['id'];
$sql = mysql_query("SELECT query FROM SIS_Querys WHERE id=$id");

$constate1 = " SELECT fono_cob.rut,Persona.Nombres,Persona.Apellido_Paterno,Persona.Apellido_Materno,fono_cob.numero_telefono,Deuda.Ano_Deuda,Deuda.Monto_Mora,Mejor_Gestion.Respuesta_N1,Mejor_Gestion.Fecha_Gestion,Mejor_Gestion.Fec_Compromiso,Mejor_Gestion.Monto_Compromiso,Mejor_Gestion.Observacion,fono_cob.color FROM fono_cob,Persona,Deuda,Mejor_Gestion WHERE fono_cob.rut IN (";
$constate2 = ") AND ( color = 1  OR color = 2) AND fono_cob.rut = Persona.Rut AND fono_cob.rut = Deuda.Rut AND fono_cob.rut = Mejor_Gestion.Rut ORDER BY fono_cob.rut , fono_cob.color ASC";

while($row=mysql_fetch_array($sql))
     {
        $query=$row[0];
     }
$queryFinal = $constate1.$query.$constate2;
$rows = mysql_query($queryFinal);
while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);


?>


