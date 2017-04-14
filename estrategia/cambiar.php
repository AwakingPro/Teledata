<?php
require_once('../db/db.php'); 

$id=$_POST['id'];
$sql=mysql_query("SELECT cantidad, monto,cola FROM SIS_Querys WHERE   id=$id");
while($row=mysql_fetch_array($sql)){
      $cantidad=$row[0];
      $monto=$row[1];
      $cola = $row[2];
}
echo "<div class='alert alert-warning fade in'>Cola = ".$cola."<br>Registros = ".$cantidad."<br>Monto = ".$monto."</div>";
?>