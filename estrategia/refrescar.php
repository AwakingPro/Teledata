<?php 
include("../db/db.php");
$id= $_POST['id'];
$sql=mysql_query("SELECT id,id_subquery,query FROM SIS_Querys WHERE id_estrategia=$id");
while ($row = mysql_fetch_row($sql))
{
    $constante = "SELECT Rut FROM Persona WHERE Rut IN ( ";
	$constante2 = " )";
	$constanteDeuda = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE Persona.Rut IN ( ";
	$constanteDeuda2 = " ) AND Persona.Rut = Deuda.Rut";
	$subQuery = $row[2];


	$id1=$row[0];
    $id_subquery=$row[1];
	
	$query1 = $constante.$subQuery.$constante2;
	$queryDeuda = $constanteDeuda.$subQuery.$constanteDeuda2;
	
	$query_1=mysql_query($query1);
	while($row2=mysql_fetch_array($query_1))
	{
		$a=$row2['Rut'];
	}
	$numero = mysql_num_rows($query_1);
	$numero = number_format($numero, 0, "", ".");
	
	$monto1 = mysql_query($queryDeuda);     
	while($row=mysql_fetch_assoc($monto1))
	{
		$monto_1= $monto_1 + $row['Monto_Mora'];
	}
	echo $monto_1 = '$  '.number_format($monto_1, 0, "", ".");

	
	
	
	
	mysql_query("UPDATE SIS_Querys SET cantidad='$numero',monto='$monto_1' WHERE id=$id1");
	
}
//
?>

	
