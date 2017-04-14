<?php
require_once('../db/db.php'); 

$id=$_POST['id'];
mysql_query("UPDATE SIS_Querys SET terminal=1 WHERE id=$id")

?>