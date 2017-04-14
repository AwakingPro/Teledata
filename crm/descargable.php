<?PHP 
require_once('../db/db.php');

$id_codigo = '307';
$lista = '939';
$periodo = $_GET['periodo'];
$cedente = '48';

$q1 = "SELECT d.Rut,d.Numero_Operacion, d.Fecha_Vencimiento, d.Saldo_Mora,d.Tipo_Deudor, m.Fecha_Gestion as Fec_Mej_Gest, n1.Nombre as N1_Mej_Gest, n2.Nombre as N2_Mej_Gest, n3.Nombre as N3_Mej_Gest,m.Fono_Gestion as Fono_Mej_Gest, u.Fecha_Gestion as Fec_Ult_gestion, u.Respuesta_N1 as N1_Ult_gestion, u.Respuesta_N2 as N2_Ult_gestion, u.Respuesta_N3 as N3_Ult_gestion, u.Fono_Gestion as Fono_Ult_gestion
			FROM Ultima_Gestion u, Mejor_Gestion_Periodo m, Deuda d, Nivel1 n1, Nivel2 n2, Nivel3 n3
			WHERE d.Rut = u.Rut and d.Rut = m.Rut and m.Id_Cedente = d.Id_Cedente and d.Id_Cedente = u.Id_Cedente and m.Id_Cedente = '$cedente' and m.Respuesta_N1 = n1.Id and m.Respuesta_N2 = n2.id and m.Respuesta_N3 = '$id_codigo' and n3.Id_Nivel2 = n2.id and n2.Id_Nivel1 = n1.id and m.lista = '$lista' AND n3.id = m.Respuesta_N3 ORDER BY d.Rut, d.Fecha_Vencimiento DESC ";

			$result = mysql_query($q1) or die("Query failed : " . mysql_error());
			   echo "Rut;Nombre;Numero Telefono;Anio Castigo;Deuda Total;Mejor Gestion;Fecha Mejor Gestion;Fecha Compromiso;Monto Compromiso;Observacion;Color;Cantidad LLamados";
			   echo "\r\n"; 
			   
			while ($line = mysql_fetch_array($result, MYSQL_BOTH)) 
			{
			$txt=$line[0].";".$line[1].";".$line[2].";".$line[3].";".$line[4].";".$line[5].";".$line[6].";".$line[7].";".$line[8].";".$line[9].";".$line[10].";".$line[11].";".$line[12]."\r\n";
			$fecha = date('Y-m-d');
			$hora  = date("G:H:s");
			$data = $fecha."_".$hora;
	header('Content-type: application/txt');

	header('Content-Disposition: attachment; filename='.$data.'.csv');

	echo $txt;
}


?>