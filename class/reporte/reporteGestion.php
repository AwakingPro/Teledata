<?php
require_once('../db/db.php');
class Grafico
{
	public function mostrarTabla($Cedente,$fechInicio,$fechaTermino)
	{
		$this->cedente=$cedente;
		$this->lista=$lista;
		$this->periodo=$periodo;
		$qr = "QR_".$this->cedente."_".$this->lista;
		if($this->lista==-1)
		{
			echo '<table id="mitabla" class="table table-striped table-bordered" cellspacing="0" width="100%">';
			echo '<thead><tr>';
			echo '<th class="min-tablet">Tipo Gestión</th>';
			echo '<th class="min-tablet">Cant. Gestiones</th>';
			echo '<th class="min-tablet">Mejor Gestion</th>';
			echo '<th class="min-tablet">Ratio</th>';
			echo '<th class="min-tablet">Porcentaje</th>';
			echo '</tr>';
			echo '</thead><tbody>';

		    $q1 = mysql_query("SELECT DISTINCT Rut FROM Deuda Where Id_Cedente = $this->cedente");
		    $total =  mysql_num_rows($q1);
		    $q6 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Id_Cedente = $this->cedente ");
		    $cg =  mysql_num_rows($q6);
		    $i = 0;
		    $q2 = mysql_query("SELECT Id,Respuesta_N1 FROM Nivel1 WHERE FIND_IN_SET('$this->cedente',Id_Cedente)");
		    while($r = mysql_fetch_array($q2))
		    {
		        $rid = $r[0];
		        $rn = utf8_encode($r[1]);
		        echo "<tr id='$rid' class='$rid'>";
		        echo "<td><button class='btn btn-icon icon-lg fa fa-plus-square nivel1'  id='d$rid' value=''></button><span class='text-xs'>$rn</span></td>";
		        echo "<td>";
		        $q3 = '';
		        if($this->periodo==1)
		        {
					$q3 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre g,Periodo_Gestion p WHERE g.resultado = $rid AND g.cedente = $this->cedente and g.fechahora BETWEEN p.Fecha_Inicio and p.Fecha_Termino and p.cedente = g.cedente");
					$q5 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre g,Periodo_Gestion p WHERE g.cedente = $this->cedente and  and g.fechahora BETWEEN p.Fecha_Inicio and p.Fecha_Termino and p.cedente = g.cedente");
				}
				elseif($this->periodo==2)
				{
					$q3 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre g WHERE g.resultado = $rid AND g.cedente = $this->cedente ");
					$q5 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre g WHERE g.cedente = $this->cedente  ");
				}
		        echo $r3 = mysql_num_rows($q3);
		        echo "</td>";
		        echo "<td>";
		        $q4 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Respuesta_N1 = $rid AND Id_Cedente = $this->cedente ");


		        $q5 = mysql_num_rows($q5);
				echo $r4 = mysql_num_rows($q4);
				echo "</td>";
				$ratio = number_format($r3/$r4, 2, '.', '');
		        echo "<td>$ratio</td>";
		        $porcentaje = number_format(($r4/$total)*100, 2, '.', '');
		        echo "<td>$porcentaje %</td>";
		        echo "</tr>";
				$i++;
		    }
		    $sg = $total - $cg;
		    $psg = number_format(($sg/$total)*100, 2, '.', '');
		    echo "<tr>";
		    echo "<td><button class='btn btn-icon icon-lg fa fa-plus-square nivel1'  id='sg' value=''></button><span class='text-xs'>EN POBLAMIENTO DE DATOS</span></td>";
		    echo "<td>0</td>";
		    echo "<td>0</td>";
		    echo "<td>0.00</td>";
		    echo "<td>0 %</td>";
		    echo "</tr>";
		    echo "<tr>";
		    echo "<td><b>Total Periodo</b></td>";
		    $qt = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre WHERE cedente = $this->cedente");
		    $total_g = mysql_num_rows($qt);
		    echo "<td>$total_g</td>";
		    echo "<td>$total</td>";
		    $total_ratio = number_format($q5/$total, 2, '.', '');
		    echo "<td>$total_ratio</td>";
		    echo "<td>100.00 %</td>";
		    echo "</tr></tbody></table>";
		    echo "<input type='hidden' id='cant_total' value='$total'>";

		}
	
	}
}
?>
