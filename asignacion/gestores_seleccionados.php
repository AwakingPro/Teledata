<?php 
$id_gestores=$_POST['id_gestores'];
$host_name = 'localhost';
$user_name = 'root';
$pass_word = 'M9a7r5s3A';
$database_name = 'foco';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);

$validar=mysql_query("SELECT * FROM SIS_Gestores WHERE id=$id_gestores AND seleccion=1 ");
if(mysql_num_rows($validar)>0){ echo "2";}
else {	
mysql_query("UPDATE SIS_Gestores SET seleccion=1 WHERE id=$id_gestores");
echo "1";
 } ?> 
	




