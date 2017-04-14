<?php
require_once('../db/db.php'); 
$id_codigo = $_POST['id'];
$lista = $_POST['cola'];
$periodo = $_POST['periodo'];
$cedente = $_POST['cedente'];
$total = $_POST['cant_total'];
$tipo = $_POST['tipo'];
if($lista==-1)
{
	$q1 = mysql_query("SELECT id,Respuesta_N2 FROM Nivel2 WHERE Id_Nivel1 = $id_codigo ");
	while($r = mysql_fetch_array($q1))
	{
		$id = $r[0]; 
		$nombre = utf8_encode($r[1]); 

		$q2 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre g,Periodo_Gestion p WHERE g.resultado_n2 = $id AND g.cedente = $cedente  and g.fechahora BETWEEN p.Fecha_Inicio and p.Fecha_Termino and p.cedente = g.cedente");


		$res = mysql_num_rows($q2);


		$q4 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Respuesta_N2 = $id AND Id_Cedente = $cedente ");
		$r4 = mysql_num_rows($q4); 

		$ratio = $res/$r4; 
		$ratio = number_format($ratio, 2, '.', '');
		$porc = number_format($r4/$total*100, 2, '.', '');
			echo "<tr class='remover$id_codigo' id='$id'><td><span class='text-xs'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button class='btn btn-icon icon-lg fa fa-plus-square nivel2'   value='' id='e$id'></button> $nombre</span></td><td>$res
				</td><td>$r4</td><td>$ratio</td><td>$porc %</td></tr>";
	}	
}
else
{



	$q1 = mysql_query("SELECT id,Respuesta_N2 FROM Nivel2 WHERE Id_Nivel1 = $id_codigo ");
	while($r = mysql_fetch_array($q1))
	{
		$id = $r[0]; 
		$nombre = utf8_encode($r[1]); 

		$q2 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre g,Periodo_Gestion p WHERE g.resultado_n2 = $id AND g.cedente = $cedente and g.lista=$lista and g.fechahora BETWEEN p.Fecha_Inicio and p.Fecha_Termino and p.cedente = g.cedente");


		$res = mysql_num_rows($q2);


		$q4 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Respuesta_N2 = $id AND Id_Cedente = $cedente and lista=$lista");
		$r4 = mysql_num_rows($q4); 

		$ratio = $res/$r4; 
		$ratio = number_format($ratio, 2, '.', '');
		$porc = number_format($r4/$total*100, 2, '.', '');
			echo "<tr class='remover$id_codigo' id='$id'><td><span class='text-xs'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button class='btn btn-icon icon-lg fa fa-plus-square nivel2'   value='' id='e$id'></button> $nombre</span></td><td>$res
				</td><td>$r4</td><td>$ratio</td><td>$porc %</td></tr>";
	}	
}	

?>