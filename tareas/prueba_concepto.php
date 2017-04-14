<?php 
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

$id_cola = 607;
$sel_cola = mysql_query("SELECT cola,query FROM SIS_Querys WHERE id=$id_cola");
while($row=mysql_fetch_array($sel_cola))
{
	$nombre_cola = $row[0];
	$query = $row[1];

}
$prefijo = "COLA_".$nombre_cola;
$crear = "CREATE TABLE $prefijo (id INT NOT NULL AUTO_INCREMENT, Rut INT ,t1 INT ,t2 INT ,t3 INT ,t4 INT ,t5 INT ,t6 INT ,KEY (id))";
mysql_query($crear);

mysql_query("INSERT INTO $prefijo (Rut) $query");

$q1 = "SELECT fono_cob.Rut , fono_cob.formato_subtel FROM fono_cob,Persona WHERE fono_cob.Rut IN (";
$q2 = ") AND fono_cob.Rut = Persona.Rut";
$query_final = $q1.$query.$q2;
$query_final = mysql_query($query_final);

$i = 1;
$fono = "t".$i;
$rut2 = "";
while($row=mysql_fetch_array($query_final))
{
	
	$rut = $row[0];
	$fono = $row[1];
	if($rut == $rut2)
	{
		$i = $i+1;
		$t = "t".$i;
		$query_update = "UPDATE $prefijo SET $t=$fono  WHERE Rut = $rut";
		mysql_query($query_update);
	}
	else
	{
		$query_update = "UPDATE $prefijo SET t1=$fono  WHERE Rut = $rut";
		mysql_query($query_update);
		$i = 1;

	}
	$rut2 = $rut;

}

?>