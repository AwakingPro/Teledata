<?php 
//ASTERISK VICIDIAL
$ConViciDial=mysql_connect('192.168.1.80','root','m9a7r5s3'); 
mysql_select_db('asterisk',$ConViciDial); 
//CONEXION A FOCO
$ConFoco=mysql_connect('192.168.1.8','root','s9q7l5.,777'); 
mysql_select_db('foco',$ConFoco); 



$QueryListas = mysql_query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.tables WHERE TABLE_NAME LIKE 'custom%' LIMIT 10",$ConViciDial);
while($row = mysql_fetch_array($QueryListas)){
   $TablaCustom = $row[0];


    $QueryCustom = mysql_query("SELECT lead_id,RUT,OBSERVACION,FEC_COMPROMISO FROM $TablaCustom",$ConViciDial);



    while($row = mysql_fetch_array($QueryCustom)){
        $LeadId = $row[0];
        $Rut = $row[1];
       	$Observacion = $row[2];
       	$FechaCompromiso = $row[3];
        //$MontoCompromiso = $row[4];

       $QueryGrabacion = mysql_query("SELECT filename FROM recording_log WHERE lead_id = $LeadId",$ConViciDial);
        while($row = mysql_fetch_array($QueryGrabacion)){
            $Grabacion = $row[0];
        }    

        $QueryLead = mysql_query("SELECT call_date,status,phone_number,user,length_in_sec,campaign_id,list_id FROM vicidial_log WHERE lead_id = $LeadId",$ConViciDial);
        while($row = mysql_fetch_array($QueryLead)){
            $CallDate = $row[0];
            $Status = $row[1];
            $PhoneNumber = $row[2];
            $Agente = $row[3];
            $Duracion = $row[4];
            $Campana = $row[5];
            $Lista = $row[6];
            $StatusName = "";
            $IdTipoGestion = "";
            $QueryStatus = mysql_query("SELECT status_name,human_answered,Id_TipoGestion FROM vicidial_statuses_homologacion WHERE status = '$Status'",$ConViciDial);
            while($row = mysql_fetch_array($QueryStatus)){
                $StatusName = $row[0];
                $Human = $row[1];
                $IdTipoGestion = $row[2];
		if($IdTipoGestion==5){
		    $FechaCompromiso = $FechaCompromiso;
		}else{
	            $FechaCompromiso = '';
		}
                if($Human=='Y'){
                    $Observacion = $Observacion;
                    $Duracion = $Duracion;
                    $Grabacion = $Grabacion;
		    
                }else{
                    $Observacion='';
                    $Duracion = '';
                    $Grabacion = '';
		   
                }
            } 
            $FechaGestion = date('Y-m-d',strtotime($CallDate));
            $HoraGestion = date('H:i:s',strtotime($CallDate));  
            

            /*mysql_query("INSERT INTO 
            gestion_vicidial_dia(rut_cliente,fecha_gestion,hora_gestion,fechahora,observacion,fono_discado,lista,cedente,nombre_ejecutivo,nombre_grabacion,
            duracion,fec_compromiso,Origen,Id_TipoGestion,status,status_name,monto_comp) 
            VALUES 
            ('$Rut','$FechaGestion','$HoraGestion','$CallDate','$Observacion','$PhoneNumber','$Lista','$Campana','$Agente','$Grabacion','$Duracion','$FechaCompromiso','1','$IdTipoGestion','$Status','$StatusName','$MontoCompromiso')",$ConFoco);
<<<<<<< HEAD
*/      

 	mysql_query("INSERT INTO gestion_vicidial_dia(rut_cliente,fechahora,observacion,fecha_gestion,hora_gestion,lista,cedente,fono_discado,duracion,nombre_ejecutivo,nombre_grabacion,Origen,Id_TipoGestion,status,status_name,fec_compromiso) VALUES ('$Rut','$CallDate','$Observacion','$FechaGestion','$HoraGestion','$Lista','$Campana','$PhoneNumber','$Duracion','$Agente','$Grabacion','1','$IdTipoGestion','$Status','$StatusName','$FechaCompromiso')",$ConFoco); 
 	}






        }

    }

    //mysql_query("DROP TABLE $TablaCustom",$ConViciDial);
    
}


?>
