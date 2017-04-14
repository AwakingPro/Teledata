<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

$tablas=$_POST['tablas'];
$id_estrategia=$_POST['id_estrategia'];
$columnas=$_POST['columnas'];
$id_clase=$_POST['id_clase'];
$logica=addslashes($_POST['logica']);
$valor=$_POST['valor'];
$siguiente_nivel=$_POST['siguiente_nivel'];
$nombre_nivel=$_POST['nombre_nivel'];



$sql=mysql_query("select * from SIS_Tablas WHERE id='$tablas'");
while($row=mysql_fetch_array($sql))
     {
     	$tablas=$row[1];
     }

$sql=mysql_query("select * from SIS_Columnas WHERE id='$columnas'");
while($row=mysql_fetch_array($sql))
     {
     	$columnas=$row[1];
     }
$query1="SELECT * FROM Maestra_Informacion_Deudor WHERE $columnas $logica $valor";     
$query_1=mysql_query($query1);

while($row2=mysql_fetch_array($query_1)){

	$a=$row2['Rut'];
}
$numero = mysql_num_rows($query_1);
$numero = number_format($numero, 0, "", ".");
$monto1=mysql_query("SELECT * FROM Maestra_Informacion_Deudor WHERE $columnas $logica $valor"); 
while($row=mysql_fetch_assoc($monto1)){
$monto_1= $monto_1 + $row['Monto_Mora'];
}

$monto_1 = '$  '.number_format($monto_1, 0, "", ".");



$query2="SELECT * FROM Maestra_Informacion_Deudor WHERE  NOT $columnas $logica $valor";
$query_2=mysql_query($query2);

while($row3=mysql_fetch_array($query_2)){

	$a=$row3['Rut'];
}
$numero2 = mysql_num_rows($query_2);
$numero2 = number_format($numero2, 0, "", ".");
$monto2=mysql_query("SELECT * FROM Maestra_Informacion_Deudor WHERE NOT $columnas $logica $valor"); 
while($row=mysql_fetch_assoc($monto2)){
$monto_2= $monto_2 + $row['Monto_Mora'];
}
$monto_2 = '$  '.number_format($monto_2, 0, "", ".");

if (empty($monto_1)){ $monto_1=0;}
if (empty($monto_2)){ $monto_2=0;}


mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,monto,cola) VALUES('$query1','$id_estrategia','$numero','$monto_1','$nombre_nivel')");
mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,monto,cola) VALUES('$query2','$id_estrategia','$numero2','$monto_2','No Seleccionado')");

$query_id1=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query1' AND id_estrategia='$id_estrategia'");
$query_id2=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query2' AND id_estrategia='$id_estrategia'");
while($row=mysql_fetch_array($query_id1)){

	$id1=$row['id'];
}

while($row=mysql_fetch_array($query_id2)){

	$id2=$row['id'];
}
$array = array('first' => "<tr id='$id1'><td><i class='psi-folder-open' id='b$id1'  style='display: none;'></i> $nombre_nivel</td><td><center>$numero</center></td><td><center>$monto_1</center></td><td><center><a class='subestrategia'  id='d$id1'  href='#'><i class='fa fa-sitemap'></i></a> &nbsp;&nbsp;<a href='#' class='link'><i class='fa fa-trash'></i></a></center></td><td><center><input type='checkbox' class='checkeo$id_clase' id='c$id1' name='c$id1' value='$id1' /></center></td></tr><tr id='$id2'><td><i class='psi-folder-open' id='b$id2'  style='display: none;'></i> No Seleccionado</td><td><center>$numero2</center></td><td><center>$monto_2</center></td><td><center><a href='#' class='subestrategia' id='d$id2'><i class='fa fa-sitemap'></i></a> &nbsp;&nbsp;<a href='#' class='link'><i class='fa fa-trash'></i></a></center></td><td><center><input type='checkbox' class='checkeo$id_clase' id='c$id2' name='c$id2' value='$id2' /></center></td></tr>", 'second' => "<input type='hidden' value='$id1' id='id_clase' name='id_clase'>");
echo json_encode($array);

?>