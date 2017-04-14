<?php
//$ConViciDial=mysql_connect('192.168.1.80','root','m9a7r5s3'); 
//mysql_select_db('asterisk',$ConViciDial); 
//CONEXION A FOCO
$ConFoco=mysql_connect('192.168.1.8','root','s9q7l5.,777'); 
mysql_select_db('foco',$ConFoco); 

$WgetRecord = mysql_query("SELECT url_grabacion FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE()",$ConFoco);
while($row=mysql_fetch_array($WgetRecord))
{
    echo $Record = $row[0];
    shell_exec("wget $Record");

}

?>
