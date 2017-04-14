<?php
require_once('../db/db.php'); 

$id=$_POST['id'];
mysql_query("UPDATE SIS_Querys SET terminal=0 WHERE id=$id")

?>