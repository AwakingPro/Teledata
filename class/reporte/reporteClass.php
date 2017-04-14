<?php
include("../../db/db.php");
include("../../mail/class.phpmailer.php");
include("../../mail/class.smtp.php");

class Reporte
{

	public $cedenteGlobal;

	public function mostrarReporteOnce($fecha,$cedente)
	{
		$this->fecha=$fecha;
		$this->cedente=$cedente;

		$queryCedenteGlobal = "SELECT Cedente_Global FROM Cedente WHERE Id_Cedente = $this->cedente LIMIT 1";
		$queryExecCedenteGlobal = mysql_query($queryCedenteGlobal);

		while($row=mysql_fetch_array($queryExecCedenteGlobal))
		{
			$cedenteGlobal = $row[0];
		}	

        $queryCedenteArray = mysql_query("SELECT Id_Cedente FROM Cedente WHERE Cedente_Global = $cedenteGlobal");
        $resultsArray = array();
        while($rowArray = mysql_fetch_array($queryCedenteArray))
        {
           $cedArray = $rowArray[0];
           array_push($resultsArray, $cedArray);
        }
        $cantArray = count($resultsArray);
        $i = 0;
        while($i<$cantArray)
        {
            $resultsArray[$i];
            $arrayIn = $arrayIn.$resultsArray[$i].",";
            $i++;
        }    
        $arrayIn = substr($arrayIn, 0, -1);
        echo "<a href='../includes/reporte/reporteOnceExcel.php'><button class='fa fa-file-excel-o btn btn-success btn-icon' id='exportarExcel'></button></a>";
        echo "<br>";
        echo "<br>";
		echo "<table id='demo-dt-basic' class='table table-striped table-bordered' cellspacing='0' width='100%'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>FECHA</th>";
        echo "<th>HORA</th>";
        echo "<th>CUENTA</th>";
        echo "<th>PRODUCTO</th>";
        echo "<th>RUT</th>";
        echo "<th>TRAMO MORA</th>";                                      
        echo "<th>MONTO MORA</th>";
        echo "<th>SALDO MORA</th>";
        echo "<th>NOMBRE GESTION</th>";
        echo "<th>TIPO GESTION</th>";
        echo "<th>NOMBRE CAUSAL</th>";
        echo "<th>NOMBRE CODIGO</th>";
        echo "<th>ID CAUSAL</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";                                
  
        $queryUno = mysql_query("SELECT g.fecha_gestion,g.hora_gestion,g.rut_cliente , p.Digito_Verificador,g.resultado ,g.resultado_n2,g.resultado_n3 , g.cedente FROM gestion_ult_semestre   g , Persona p  WHERE g.fecha_gestion = '$this->fecha' AND cedente IN ($arrayIn) AND g.rut_cliente = p.Rut "); 
        while($row1 = mysql_fetch_array($queryUno))
        {
            $rut = $row1[2];
            $resultado = $row1[4];
            $resultado2 = $row1[5];
            $resultado3 = $row1[6];
            $cedenteNuevo = $row1[7];
            echo "<tr>";
            echo "<td>".$row1[0]."</td>";
            echo "<td>".$row1[1]."</td>";                                
            echo "<td>".$row1[2]."</td>";
            echo "<td>".$cedenteNuevo."</td>";
            echo "<td>".$row1[2]."-".$row1[3]."</td>";
            $queryDos = mysql_query("SELECT Tramo_Dias_Mora,Monto_Mora,Saldo_Mora FROM Deuda WHERE Rut = $rut AND Id_Cedente IN ($arrayIn) GROUP BY Rut LIMIT 1");
            while($row2 = mysql_fetch_array($queryDos))
            {
                $tramo = $row2[0];
                $monto = $row2[1];
                $saldo = $row2[2];
            }   
            echo "<td>".$tramo."</td>";
            echo "<td>".$monto."</td>";
            echo "<td>".$saldo."</td>";
            echo "<td>GESTION TELEFONICA</td>";
            $queryTres = mysql_query("SELECT Nivel_2_Claro ,Nivel_3_Claro FROM  CLARO_homologacion_foco  WHERE id1 = $resultado AND id2 = $resultado2 AND id3 = $resultado3 LIMIT 1");
            while($row3 = mysql_fetch_array($queryTres))
            {
                $result = $row3[0];
                $result3 = $row3[1];
                $queryCuatro = mysql_query("SELECT tipo_contacto,descripcion FROM  CLARO_resultado_foco_gestion  WHERE codigo='$result' LIMIT 1");
                while($row4 = mysql_fetch_array($queryCuatro))
                {
                    $result_final = $row4[0];
                    $id_causal = $row4[1];                             
                }  
                $queryCinco = mysql_query("SELECT Id,Descripcion FROM  CLARO_causal_mora WHERE codigo='$result3' LIMIT 1");
                while($row5 = mysql_fetch_array($queryCinco))
                {
                    $id = $row5[0];
                    $desc= $row5[1];                              
                }   
            }
                                                    
            echo "<td>".$result_final."</td>";
            echo "<td>".$desc."</td>";
            echo "<td>".$id_causal."</td>";
            echo "<td>".$id."</td>";
            echo "</tr>";  
                                       
        } 
        echo "</tbody>";
        echo "</table>";
	}

    public function mostrarReporteSupervisor($cedente)
    {
        $this->cedente=$cedente;
        //echo "<a href='../includes/reporte/reporteOnceExcel.php'><button class='fa fa-file-excel-o btn btn-success btn-icon' id='exportarExcel'></button></a>";
        echo "<br>";
        echo "<br>";
        echo "<table id='demo-dt-basic' class='table table-striped table-bordered' cellspacing='0' width='100%'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Rut</th>";
        echo "<th>Nombre</th>";
        echo "<th>Fono</th>";
        echo "<th>Ultima Gestion</th>";
        echo "<th>Fecha Ult Gestion</th>";
        echo "<th>Color Fono</th>";
        echo "<th>Cant. Discado <br> Ultimo Semestre</th>";
        echo "<th>Fecha Comp</th>";
        echo "<th>Monto Comp</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>"; 
        $queryPersona = mysql_query("SELECT p.Rut,p.Nombre_Completo,f.formato_subtel,f.color FROM Persona p , fono_cob f WHERE p.Rut = f.Rut AND FIND_IN_SET ('$this->cedente',p.Id_Cedente) ");
        while($row = mysql_fetch_array($queryPersona))
        {
            
            $rutPersona = $row['0'];
            $nombrePersona = $row['1'];
            $fonoCob = $row['2'];
            $colorFonoCob = $row['3'];

            $queryColor = mysql_query("SELECT tipo_var ,color_hex  FROM SIS_Categoria_Fonos WHERE color = $colorFonoCob");
            $colorFono = '';
            $colorHex = '';
            while($row = mysql_fetch_array($queryColor))
            {
                $colorFono = $row['0'];
                $colorHex= $row['1'];
            }
            echo "<tr>";
            echo "<td>".$rutPersona."</td>";
            echo "<td>".$nombrePersona."</td>";
            echo "<td>".$fonoCob."</td>";
            $queryMejorGestionPeriodo = mysql_query("SELECT Tipo_Contacto,Fecha_Gestion FROM Ultima_Gestion WHERE Rut = $rutPersona AND Fono_Gestion = $fonoCob ");
            $tipoContacto = '';
            $fechaUltGestion = '';
            while($row1 = mysql_fetch_array($queryMejorGestionPeriodo))
            {
                $tipoContacto = $row1[0];
                $fechaUltGestion = $row1[1];
            } 
            
            $queryTipoFinal = mysql_query("SELECT Nombre FROM Tipo_Contacto WHERE Id_TipoContacto = $tipoContacto");
            $tipoContactoFinal = '';
            while($row1 = mysql_fetch_array($queryTipoFinal))
            {
                $tipoContactoFinal = $row1[0];
            }  
         
            echo "<td>".$tipoContactoFinal."</td>";
            echo "<td>".$fechaUltGestion."</td>";
            echo "<td><i class='fa fa-flag fa-lg icon-lg' style='color:$colorHex'></i>"." ".$colorFono."</td>";
            $contarFono = 0;
            $queryContarFono = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre WHERE fono_discado = $fonoCob AND rut_cliente = $rutPersona");
            $contarFono = mysql_num_rows($queryContarFono);          
            echo "<td>".$contarFono."</td>";
            $fechaComp = '';
            $queryFechaComp = mysql_query("SELECT fec_compromiso,monto_comp FROM gestion_ult_semestre WHERE fono_discado = $fonoCob AND rut_cliente = $rutPersona");
            while($row2 = mysql_fetch_array($queryFechaComp))
            {
                $fechaComp = $row2[0];
                $montoComp = $row2[1];
            }  
         

            echo "<td>".$fechaComp."</td>";
            echo "<td>".$montoComp."</td>";

            echo "</tr>";  
        }    
        echo "</tbody>";
        echo "</table>";
    }
  
}
?>
