<?php
require_once("../functions/Functions.php");
require_once('../../db/db.php'); 
$id_codigo = $_POST['id'];
$lista = $_POST['cola'];
$periodo = $_POST['periodo'];
$cedente = $_SESSION['cedente'];
$total = $_POST['total'];
$tipo = $_POST['tipo'];
if($lista==-1)
{
    echo "SELECT id,Respuesta_N3 FROM Nivel3 WHERE Id_Nivel2 = $id_codigo ";
	$q1 = mysql_query("SELECT id,Respuesta_N3 FROM Nivel3 WHERE Id_Nivel2 = $id_codigo ");
	while($r = mysql_fetch_array($q1))
	{
		$id = $r[0]; 
		$nombre = utf8_encode($r[1]); 

		$q2 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre g,Periodo_Gestion p WHERE g.resultado_n3 = $id AND g.cedente = $cedente and g.fechahora BETWEEN p.Fecha_Inicio and p.Fecha_Termino and p.cedente = g.cedente");
		$res = mysql_num_rows($q2);

		$q4 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Respuesta_N3 = $id AND Id_Cedente = $cedente ");
		$r4 = mysql_num_rows($q4);

		$ratio = $r4==0 ? 0 :$res/$r4; 
		$ratio = number_format($ratio, 2, '.', '');
		$porc = $total==0 ? number_format(0, 2, '.', '') : number_format($r4/$total*100, 2, '.', '');
		echo "<tr class='removerNivel2' id='$id'><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		if($res==0)
		{
			echo "<span class='text-xs'> $nombre</span></td><td>$res</td><td>$r4</td><td>$ratio</td><td>$porc %</td></tr>";
		}	
		else
		{
			echo "<button class='btn btn-icon icon-lg fa fa-search ver_detalle'   value='' id=''></button><span class='text-xs'> $nombre</span></td><td>$res</td><td>$r4</td><td>$ratio</td><td>$porc %</td></tr>";
		}	
		
	}	
}
else
{
	$q1 = mysql_query("SELECT id,Respuesta_N3 FROM Nivel3 WHERE Id_Nivel2 = $id_codigo ");
	while($r = mysql_fetch_array($q1))
	{
		$id = $r[0]; 
		$nombre = utf8_encode($r[1]); 

		$q2 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre g,Periodo_Gestion p WHERE g.resultado_n3 = $id AND g.cedente = $cedente and g.lista=$lista and g.fechahora BETWEEN p.Fecha_Inicio and p.Fecha_Termino and p.cedente = g.cedente");
		$res = mysql_num_rows($q2);

		$q4 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Respuesta_N3 = $id AND Id_Cedente = $cedente and lista=$lista");
		$r4 = mysql_num_rows($q4); 

		$ratio = $r4==0 ? 0 :$res/$r4; 
		$ratio = number_format($ratio, 2, '.', '');
		$porc = $total==0 ? number_format(0, 2, '.', '') : number_format($r4/$total*100, 2, '.', '');
		echo "<tr class='removerNivel2' id='$id'><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		if($res==0)
		{
			echo "<span class='text-xs'> $nombre</span></td><td>$res</td><td>$r4</td><td>$ratio</td><td>$porc %</td></tr>";
		}	
		else
		{
			echo "<button class='btn btn-icon icon-lg fa fa-search ver_detalle'   value='' id=''></button><span class='text-xs'> $nombre</span></td><td>$res</td><td>$r4</td><td>$ratio</td><td>$porc %</td></tr>";
		}	
		
	}	
}	


?>