<?php

 

/* Connecting, selecting database */

$link = mysql_connect("200.29.187.59", "svergara", "svergara.2012")

   or die("Could not connect : " . mysql_error());

mysql_select_db("reporteria",$link) or die("Could not select database");

 

/* Connecting, selecting database */

$link2 = mysql_connect("localhost", "root", "M9a7r5s3A")

    or die("Could not connect : " . mysql_error());

mysql_select_db("foco",$link2) or die("Could not select database");

 

$query = mysql_query("SELECT * FROM gestion_ult_trimestre limit 10000",$link);

while($row = mysql_fetch_array($query))

{

                $rut = $row['rut_cliente'];

                $fecha_gestion = $row['fecha_gestion'];

                $hora_gestion = $row['hora_gestion'];

                $fechahora = $row['fechahora'];

                $resultado = $row['resultado'];

                $subrespuesta = $row['subrespuesta'];

                $observacion = $row['observacion'];

                $fono_discado = $row['fono_discado'];

                $lista = $row['lista'];

                $nombre_ejecutivo = $row['nombre_ejecutivo'];

                $nombre_grabacion = $row['nombre_grabacion'];

                $duracion = $row['duracion'];

                $cedente = $row['cedente'];

                $fec_compromiso = $row['fec_compromiso'];

                $origen = $row['origen'];

                $id_eje = $row['id_eje'];

                $monto_comp = $row['monto_comp'];
              //  mysql_query("INSERT INTO gestion_ult_trimestre (rut_cliente) VALUES ('$rut')",$link2);
              echo mysql_query("INSERT IGNORE INTO gestion_ult_trimestre (rut_cliente,fecha_gestion,hora_gestion,fechahora,resultado,subrespuesta,observacion,fono_discado,lista,nombre_ejecutivo,nombre_grabacion,duracion,cedente,fec_compromiso,origen,id_eje,monto_comp) VALUES ('$rut','$fecha_gestion','$hora_gestion','$fechahora','$resultado','$subrespuesta','$observacion','$fono_discado','$lista','$nombre_ejecutivo','$nombre_grabacion','$duracion,'$cedente','$fec_compromiso','$origen','$id_eje','$monto_comp')",$link2);


}

 

mysql_close($link);

mysql_close($link2);

?>
