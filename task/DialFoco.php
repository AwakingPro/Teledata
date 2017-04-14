<?php 
//ASTERISK VICIDIAL
$ConViciDial=mysql_connect('192.168.1.80','root','m9a7r5s3'); 
mysql_select_db('asterisk',$ConViciDial); 
//CONEXION A FOCO
$ConFoco=mysql_connect('192.168.1.8','root','s9q7l5.,777'); 
mysql_select_db('foco',$ConFoco); 



$QueryListas = mysql_query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.tables WHERE TABLE_NAME LIKE 'custom%' ",$ConViciDial);
while($row = mysql_fetch_array($QueryListas)){
   $TablaCustom = $row[0];


    $QueryCustom = mysql_query("SELECT lead_id,RUT,OBSERVACION,FEC_COMPROMISO FROM $TablaCustom ",$ConViciDial);



    while($row = mysql_fetch_array($QueryCustom)){
        $LeadId = $row[0];
        $Rut = $row[1];
       	$ObservacionP= $row[2];
       	$FechaCompromisoP= $row[3];
        //$MontoCompromiso = $row[4];

       $QueryGrabacion = mysql_query("SELECT filename,location FROM recording_log WHERE lead_id = $LeadId",$ConViciDial);
        while($row = mysql_fetch_array($QueryGrabacion)){
            $GrabacionP = $row[0];
	    $LocationP = $row[1];
        }    

        $QueryLead = mysql_query("SELECT call_date,status,phone_number,user,length_in_sec,campaign_id,list_id FROM vicidial_log WHERE lead_id = $LeadId",$ConViciDial);
        while($row = mysql_fetch_array($QueryLead)){
            $CallDate = $row[0];
            $Status = $row[1];
            $PhoneNumber = $row[2];
            $Agente = $row[3];
            $DuracionP = $row[4];
            $Campana = $row[5];
            $Lista = $row[6];
            $StatusName = "";
            $IdTipoGestion = "";
            $QueryStatus = mysql_query("SELECT status_name,human_answered,Id_TipoGestion,Ponderacion FROM vicidial_statuses_homologacion WHERE status = '$Status'",$ConViciDial);
            while($row = mysql_fetch_array($QueryStatus)){
                $StatusName = $row[0];
                $Human = $row[1];
                $IdTipoGestion = $row[2];
		$Ponderacion = $row[3];
		if($IdTipoGestion==5){
		    $FechaCompromiso = $FechaCompromisoP;
		}else{
	            $FechaCompromiso = '';
		}
                if($Human=='Y'){
                    $Observacion = $ObservacionP;
                    $Duracion = $DuracionP;
                    $Grabacion = $GrabacionP;
		    $Location = $LocationP;
		    
                }else{
                    $Observacion='';
                    $Duracion = '';
                    $Grabacion = '';
	            $Location = '';
		   
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

 	echo $Insert = "INSERT INTO gestion_ult_trimestre(rut_cliente,fechahora,observacion,fecha_gestion,hora_gestion,lista,cedente,fono_discado,duracion,nombre_ejecutivo,nombre_grabacion,origen,Id_TipoGestion,status,status_name,fec_compromiso,Ponderacion,url_grabacion) VALUES ('$Rut','$CallDate','$Observacion','$FechaGestion','$HoraGestion','$Lista','$Campana','$PhoneNumber','$Duracion','$Agente','$Grabacion','777','$IdTipoGestion','$Status','$StatusName','$FechaCompromiso','$Ponderacion','$Location')";
	mysql_query($Insert,$ConFoco); 
 	






        }

    }

    //mysql_query("DROP TABLE $TablaCustom",$ConViciDial);
    
}


?>
