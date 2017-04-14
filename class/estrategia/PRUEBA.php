<?php
include("../../db/db.php");

		$querya=mysql_query("SELECT id_subquery,condicion,columna  FROM SIS_Querys WHERE id=269 AND id_estrategia=117");
		while($row=mysql_fetch_array($querya))
		{
		  echo $id_subquery = $row[2]; 
		}  
?>		  