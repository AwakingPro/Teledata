<?php 
//ASTERISK VICIDIAL
$ConSeba=mysql_connect('192.168.1.91','svergara','svergara.2012'); 
mysql_select_db('reporteria',$ConSeba); 
//CONEXION A FOCO
$ConFoco=mysql_connect('192.168.1.8','root','s9q7l5.,777'); 
mysql_select_db('foco',$ConFoco); 

$ConDial=mysql_connect('192.168.1.80','root','m9a7r5s3'); 
mysql_select_db('asterisk',$ConDial); 




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
    mysql_query("DELETE FROM gestion_ult_trimestre WHERE id_gestion = $IdGestion",$ConSeba);
}

?>

 