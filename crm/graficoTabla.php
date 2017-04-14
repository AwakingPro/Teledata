<?php
require_once('../db/db.php');
class Grafico
{
	public function mostrarTabla($cedente,$lista,$periodo)
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
		else
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

		    $q1 = mysql_query("SELECT Rut FROM $qr ");
		    $total =  mysql_num_rows($q1);
		    $q6 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Id_Cedente = $this->cedente and lista=$this->lista");
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
					$q3 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre g,Periodo_Gestion p WHERE g.resultado = $rid AND g.cedente = $this->cedente and g.lista=$this->lista and g.fechahora BETWEEN p.Fecha_Inicio and p.Fecha_Termino and p.cedente = g.cedente");
					$q5 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre g,Periodo_Gestion p WHERE g.cedente = $this->cedente and g.lista=$this->lista and g.fechahora BETWEEN p.Fecha_Inicio and p.Fecha_Termino and p.cedente = g.cedente");
				}
				elseif($this->periodo==2)
				{
					$q3 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre g WHERE g.resultado = $rid AND g.cedente = $this->cedente and g.lista=$this->lista ");
					$q5 = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre g WHERE g.cedente = $this->cedente and g.lista=$this->lista ");
				}
		        echo $r3 = mysql_num_rows($q3);
		        echo "</td>";
		        echo "<td>";
		        $q4 = mysql_query("SELECT Rut FROM Mejor_Gestion_Periodo WHERE Respuesta_N1 = $rid AND Id_Cedente = $this->cedente and lista=$this->lista");


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
		    $qt = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre WHERE cedente = $this->cedente");
		    $total_g = mysql_num_rows($qt);
		    echo "<tr>";
		    echo "<td><button class='btn btn-icon icon-lg fa fa-plus-square nivel1'  id='sg' value=''></button><span class='text-xs'>EN POBLAMIENTO DE DATOS</span></td>";
		    echo "<td>0</td>";
		    echo "<td>$sg</td>";
		    echo "<td>0.00</td>";
		    echo "<td>$psg %</td>";
		    echo "</tr>";
		    echo "<tr>";
		    echo "<td><b>Total Periodo</b></td>";
		    echo "<td>$total_g</td>";
		    echo "<td>$total</td>";
		    $total_ratio = number_format($q5/$total, 2, '.', '');
		    echo "<td>$total_ratio</td>";
		    echo "<td>100.00 %</td>";
		    echo "</tr></tbody></table>";
		    echo "<input type='hidden' id='cant_total' value='$total'>";
		}
	}
	public function mostrarCedente($id)
	{
		$this->id=$id;
		$q1 = mysql_query("SELECT id,nombre FROM SIS_Estrategias WHERE Id_Cedente = $this->id");
		echo '<label for="sel1">Seleccione Estrategia</label>';
        echo '<select class="form-control ChartTortaSelector" id="seleccione_estrategia">';
        echo '<option value="0">Seleccione</option>';
        echo '<option value="-1">TOTAL CARTERA</option>';
		while($r1 = mysql_fetch_array($q1))
		{
            $id = $r1[0];
            $nombre = $r1[1];
            echo "<option value='$r1[0]'>$r1[1]</option>";
		}
		echo '</select>';
	}
	public function mostrarEstrategia($id)
	{
		$this->id=$id;
		$q1 = mysql_query("SELECT id,cola FROM SIS_Querys WHERE id_estrategia = $this->id AND terminal = 1");
		echo '<label for="sel1">Seleccione Cola</label>';

        echo '<select class="form-control ChartTortaSelector" id="seleccione_cola">';
        echo '<option value="0">Seleccione</option>';
        echo '<option value="-1">TOTAL CARTERA</option>';

		while($r1 = mysql_fetch_array($q1))
		{
            $id = $r1[0];
            $nombre = $r1[1];
            echo "<option value='$r1[0]'>$r1[1]</option>";
		}
		echo '</select>';
	}
	public function crearTablaExportable($id,$lista,$cedente)
	{
		$this->id=$id;
		$this->cedente=$cedente;
		$this->lista=$lista;
		if($this->lista==-1)
		{
	        echo '<table id="tabla_super" class="table table-striped table-bordered" cellspacing="0" width="100%">';
	        echo '<thead>';
	        echo '<tr><tr>';
	        echo '<th class="text-sm" data-priority="1">Rut</th>';
	        echo '<th class="text-sm">Numero Operacion</th>';
	        echo '<th class="text-sm">Fecha Vencimiento</th>';
	        echo '<th class="text-sm" data-priority="2">Deuda Mora</th>';
	        echo '<th class="text-sm" data-priority="2">Tramo</th>';
	        echo '<th class="text-sm" data-priority="2">Fec. Mej. Gestion</th>';
	        echo '<th class="text-sm" data-priority="2">Accion Mej. Gest.</th>';
	        echo '<th class="text-sm" data-priority="2">Resp. Mej. Gest.</th>';
	        echo '<th class="text-sm" data-priority="2">Subresp. Mej. Gest.</th>';
	        //echo '<th class="text-sm">Fono Mej. Gest.</th>';
	        echo '<th class="text-sm" data-priority="2">Fec. Ult. Gestion</th>';
	        echo '<th class="text-sm" data-priority="2">Accion Ult. Gest.</th>';
	        echo '<th class="text-sm" data-priority="2">Resp. Ult. Gest.</th>';
	        echo '<th class="text-sm" data-priority="2">Subresp. Ult. Gest.</th>';
	        //echo '<th class="text-sm">Fono Ult. Gest.</th>';
	        echo '</thead><tbody>';

	        $q1 = mysql_query("SELECT d.Rut,d.Numero_Operacion, d.Fecha_Vencimiento, d.Saldo_Mora,d.Tipo_Deudor, m.Fecha_Gestion as Fec_Mej_Gest, n1.Respuesta_N1 as N1_Mej_Gest, n2.Respuesta_N2 as N2_Mej_Gest, n3.Respuesta_N3 as N3_Mej_Gest,m.Fono_Gestion as Fono_Mej_Gest, u.Fecha_Gestion as Fec_Ult_gestion, u.Respuesta_N1 as N1_Ult_gestion, u.Respuesta_N2 as N2_Ult_gestion, u.Respuesta_N3 as N3_Ult_gestion, u.Fono_Gestion as Fono_Ult_gestion
			FROM Ultima_Gestion u, Mejor_Gestion_Periodo m, Deuda d, Nivel1 n1, Nivel2 n2, Nivel3 n3
			WHERE d.Rut = u.Rut and d.Rut = m.Rut and m.Id_Cedente = d.Id_Cedente and d.Id_Cedente = u.Id_Cedente and m.Id_Cedente = '$this->cedente' and m.Respuesta_N1 = n1.Id and m.Respuesta_N2 = n2.id and m.Respuesta_N3 = '$this->id' and n3.Id_Nivel2 = n2.id and n2.Id_Nivel1 = n1.id  AND n3.id = m.Respuesta_N3 ORDER BY d.Rut, d.Fecha_Vencimiento DESC ");

		    while($row = mysql_fetch_array($q1))
	        {
	        	$rut = $row[0];
	        	$numop = $row[1];
	        	$fecvenc = $row[2];
	        	$mora = $row[3];
	        	$tipodeudor = $row[4];
	        	$fec_mej_gest = $row[5];
	        	$n1_mej_gest = $row[6];
	        	$n2_mej_gest = $row[7];
	        	$n3_mej_gest = $row[8];
	        	$fono_mej_gest = $row[9];
	        	$fec_ult_gest = $row[10];
	        	$n1_ult_gest = $row[11];
	        	$n2_ult_gest = $row[12];
	        	$n3_ult_gest = $row[13];
	        	$fono_ult_gest = $row[14];

	        	echo "<tr id='$i'>";
			    echo "<td class='text-sm'><center>$rut</center></td>";
			    echo "<td class='text-sm'><center>$numop</center></td>";
			    echo "<td class='text-sm'><center>$fecvenc</center></td>";
			    echo "<td class='text-sm'><center>$mora</center></td>";
			    echo "<td class='text-sm'><center>$tipodeudor</center></td>";
			    echo "<td class='text-sm'><center>$fec_mej_gest</center></td>";
			    echo "<td class='text-sm'><center>$n1_mej_gest</center></td>";
			    echo "<td class='text-sm'><center>$n2_mej_gest</center></td>";
			    echo "<td class='text-sm'><center>$n3_mej_gest</center></td>";
			    //echo "<td class='text-sm'><center>$fono_mej_gest</center></td>";
			    echo "<td class='text-sm'><center>$fec_ult_gest</center></td>";
			    echo "<td class='text-sm'><center>$n1_ult_gest</center></td>";
			    echo "<td class='text-sm'><center>$n2_ult_gest</center></td>";
			    echo "<td class='text-sm' ><center>$n3_ult_gest</center></td>";
			    //echo "<td class='text-sm'><center>$fono_ult_gest</center></td>";
			    echo '</tr>';
	 		}
	    	echo '</tbody></table>';
		}
		else
		{

			echo '<div class="table-responsive">';
	        echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
	        echo '<thead>';
	        echo '<tr><tr>';
	        echo '<th class="text-sm">Rut</th>';
	        echo '<th class="text-sm">Numero Operacion</th>';
	        echo '<th class="text-sm">Fecha Vencimiento</th>';
	        echo '<th class="text-sm">Deuda Mora</th>';
	        echo '<th class="text-sm">Tramo</th>';
	        echo '<th class="text-sm">Fec. Mej. Gestion</th>';
	        echo '<th class="text-sm">Accion Mej. Gest.</th>';
	        echo '<th class="text-sm">Resp. Mej. Gest.</th>';
	        echo '<th class="text-sm">Subresp. Mej. Gest.</th>';
	        echo '<th class="text-sm">Fono Mej. Gest.</th>';
	        echo '<th class="text-sm">Fec. Ult. Gestion</th>';
	        echo '<th class="text-sm">Accion Ult. Gest.</th>';
	        echo '<th class="text-sm">Resp. Ult. Gest.</th>';
	        echo '<th class="text-sm">Subresp. Ult. Gest.</th>';
	        echo '<th class="text-sm">Fono Ult. Gest.</th>';
	        echo '</thead><tbody>';

	        $q1 = mysql_query("SELECT d.Rut,d.Numero_Operacion, d.Fecha_Vencimiento, d.Saldo_Mora,d.Tipo_Deudor, m.Fecha_Gestion as Fec_Mej_Gest, n1.Respuesta_N1 as N1_Mej_Gest, n2.Respuesta_N2 as N2_Mej_Gest, n3.Respuesta_N3 as N3_Mej_Gest,m.Fono_Gestion as Fono_Mej_Gest, u.Fecha_Gestion as Fec_Ult_gestion, u.Respuesta_N1 as N1_Ult_gestion, u.Respuesta_N2 as N2_Ult_gestion, u.Respuesta_N3 as N3_Ult_gestion, u.Fono_Gestion as Fono_Ult_gestion
			FROM Ultima_Gestion u, Mejor_Gestion_Periodo m, Deuda d, Nivel1 n1, Nivel2 n2, Nivel3 n3
			WHERE d.Rut = u.Rut and d.Rut = m.Rut and m.Id_Cedente = d.Id_Cedente and d.Id_Cedente = u.Id_Cedente and m.Id_Cedente = '$this->cedente' and m.Respuesta_N1 = n1.Id and m.Respuesta_N2 = n2.id and m.Respuesta_N3 = '$this->id' and n3.Id_Nivel2 = n2.id and n2.Id_Nivel1 = n1.id and m.lista = '$this->lista' AND n3.id = m.Respuesta_N3 ORDER BY d.Rut, d.Fecha_Vencimiento DESC ");

		    while($row = mysql_fetch_array($q1))
	        {
	        	$rut = $row[0];
	        	$numop = $row[1];
	        	$fecvenc = $row[2];
	        	$mora = $row[3];
	        	$tipodeudor = $row[4];
	        	$fec_mej_gest = $row[5];
	        	$n1_mej_gest = $row[6];
	        	$n2_mej_gest = $row[7];
	        	$n3_mej_gest = $row[8];
	        	$fono_mej_gest = $row[9];
	        	$fec_ult_gest = $row[10];
	        	$n1_ult_gest = $row[11];
	        	$n2_ult_gest = $row[12];
	        	$n3_ult_gest = $row[13];
	        	$fono_ult_gest = $row[14];

	        	echo "<tr id='$i'>";
			    echo "<td class='text-sm'><center>$rut</center></td>";
			    echo "<td class='text-sm'><center>$numop</center></td>";
			    echo "<td class='text-sm'><center>$fecvenc</center></td>";
			    echo "<td class='text-sm'><center>$mora</center></td>";
			    echo "<td class='text-sm'><center>$tipodeudor</center></td>";
			    echo "<td class='text-sm'><center>$fec_mej_gest</center></td>";
			    echo "<td class='text-sm'><center>$n1_mej_gest</center></td>";
			    echo "<td class='text-sm'><center>$n2_mej_gest</center></td>";
			    echo "<td class='text-sm'><center>$n3_mej_gest</center></td>";
			    echo "<td class='text-sm'><center>$fono_mej_gest</center></td>";
			    echo "<td class='text-sm'><center>$fec_ult_gest</center></td>";
			    echo "<td class='text-sm'><center>$n1_ult_gest</center></td>";
			    echo "<td class='text-sm'><center>$n2_ult_gest</center></td>";
			    echo "<td class='text-sm'><center>$n3_ult_gest</center></td>";
			    echo "<td class='text-sm'><center>$fono_ult_gest</center></td>";
			    echo '</tr>';
	 		}
	    	echo '</tbody></table></div>';
	    }
	}

}
?>
