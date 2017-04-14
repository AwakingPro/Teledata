<?php 
include("../db/db.php");
$id= $_POST['id'];
$sql=mysql_query("SELECT id,id_subquery FROM SIS_Querys WHERE id_estrategia=$id ORDER BY id DESC LIMIT 2");
while ($row = mysql_fetch_row($sql))
{
    $id1=$row[0];
    $id_subquery=$row[1];
    mysql_query("DELETE FROM SIS_Querys WHERE id=$id1");
   
}
mysql_query("UPDATE SIS_Querys SET carpeta=0,sub=1 WHERE id=$id_subquery");
?>

	
