<?php
require_once('../db/db.php'); 

$id=$_GET['id_estrategia'];
mysql_query("DELETE FROM SIS_Estrategias WHERE   id=$id");
mysql_query("DELETE FROM SIS_Querys WHERE   id_estrategia=$id");
header('Location: estrategias.php');
?>