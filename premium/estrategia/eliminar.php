<?php

$id = $_POST['id'];
$conexion = mysql_connect("localhost" , "lponce" , "asd123");
mysql_select_db("ajax",$conexion);
mysql_query("DELETE FROM id WHERE id=$id");


?>