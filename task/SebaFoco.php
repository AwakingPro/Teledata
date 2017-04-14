<?php 
//ASTERISK VICIDIAL
$ConSeba=mysql_connect('192.168.1.91','svergara','svergara.2012'); 
mysql_select_db('reporteria',$ConSeba); 
//CONEXION A FOCO
$ConFoco=mysql_connect('192.168.1.8','root','s9q7l5.,777'); 
mysql_select_db('foco',$ConFoco); 

$ConDial=mysql_connect('192.168.1.80','root','m9a7r5s3'); 
mysql_select_db('asterisk',$ConDial); 



$QueryGestion = mysql_query("SELECT id_gestion,rut_cliente,resultado,fecha_gestion,hora_gestion,fechahora,resultado,observacion,fono_discado,nombre_grabacion,duracion,cedente,fec_compromiso,origen,monto_comp,lista,nombre_ejecutivo FROM gestion_ult_trimestre_b ",$ConSeba);
while($row = mysql_fetch_array($QueryGestion)){
   $IdGestion = $row[0];
   $Rut = $row[1];
   $IdResultado = $row[2];
   $FechaGestion = $row[3];
   $HoraGestion= $row[4];
   $FechaHora = $row[5];
   $ResultadoH = $row[6];
   $Observacion = $row[7];
   $FonoDiscado = $row[8];
   $NombreGrabacion = $row[9];
   $Duracion = $row[10];
   $Cedente = $row[11];
   $FechaCompromiso = $row[12];
   $Origen = $row[13];
   $MontoCompromiso = $row[14];
   $Lista = $row[15];
   $Agente = $row[16];
   $Resultado = '';
   $Ponderacion = 0;
   $QueryRespuestaGestion = mysql_query("SELECT resultado,peso FROM respuesta_gestion WHERE id = $IdResultado ",$ConSeba);
   while($row = mysql_fetch_array($QueryRespuestaGestion)){
       $StatusName = $row[0];
       $Ponderacion = $row[1];
   }
   $Status = '';
   $QueryStatus = mysql_query("SELECT status,Id_TipoGestion FROM vicidial_statuses_homologacion WHERE status_name = '$StatusName' ",$ConDial);
   while($row = mysql_fetch_array($QueryStatus)){
        $Status = $row[0];
        $IdTipoGestion = $row[1];
   }
   

   echo $Rut."-".$Status."-".$StatusName."-".$IdTipoGestion."<BR>";
   mysql_query("INSERT INTO gestion_ult_trimestre(rut_cliente,fecha_gestion,hora_gestion,fechahora,resultado,observacion,fono_discado,lista,nombre_ejecutivo,nombre_grabacion,duracion,cedente,fec_compromiso,monto_comp,status,status_name,Id_TipoGestion,Ponderacion) VALUES 
   ('$Rut','$FechaGestion','$HoraGestion','$FechaHora','$ResultadoH','$Observacion','$FonoDiscado','$Lista','$Agente','$NombreGrabacion','$Duracion','$Cedente','$FechaCompromiso','$MontoCompromiso','$Status','$StatusName','$IdTipoGestion','$Ponderacion')",$ConFoco); 
    mysql_query("DELETE FROM gestion_ult_trimestre_b WHERE id_gestion = $IdGestion",$ConSeba);
}

?>

 
