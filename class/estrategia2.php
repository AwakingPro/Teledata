<?php
include("../db/db.php");
class Estrategia
{
	public function asignarColumnas($id)
	{
		$this->id=$id;
	}
	public function mostrarColumnas()
	{
		$query=mysql_query("SELECT id,columna,alias FROM SIS_Columnas WHERE id_tabla=$this->id AND view=1");
		echo "<select name='columnas' id='columnas' class='select1' >";
		echo "<option value='0'>Seleccione Columna</option>";
		while ($row=mysql_fetch_array($query))
		{ 
			$id1=$row[0];
			$columna = $row[1];
			$alias= $row[2];
			if($alias=='')
			{
				echo "<option value='$id1'>$columna</option>";
			}
			else
			{
				echo "<option value='$id1'>$alias</option>";
			}	
		} 
		echo "</select>";  
	}
	public function asignarLogica($idc)
	{
		$this->idc=$idc;
	}
	public function mostrarLogica()
	{
		$columnas=mysql_query("SELECT columna,logica FROM SIS_Columnas WHERE id=$this->idc");
		while ($row = mysql_fetch_row($columnas))
		{
			$columna=$row[0];	
			$logica=$row[1];
		    if($logica==0)
			{ 
		  		$var_logica = '<select name="logica" class="select1" id="logica"><option value="0">';
			    $var_logica += 'Seleccione Lógica</option><option value="<">Menor</option><option value=">">';
				$var_logica += 'Mayor</option><option value="=">Igual</option><option value="<=">Menor o Igual';
				$var_logica += '</option><option value=">=">Mayor o Igual</option><option value="!=">Distinto';
				$var_logica += '</option></select>';
				
			}
			else
			{
		  		$var_logica = "<select name='logica' class='select1' id='logica'><option value='0'>";
			    $var_logica += "Seleccione Lógica</option><option value='='>Igual</option><option value='!=''>";
				$var_logica += " Distinto</option></select>";
				echo $var_logica;
			}
		}
	}
	public function asignarValor($idv)
	{
		$this->idv=$idv;
	}
	public function mostrarValor()
	{
		$columnas=mysql_query("SELECT tipo_dato,columna,relacion,orden,id_tabla,nombre_nulo FROM SIS_Columnas where id=$this->idv");
		while ($row = mysql_fetch_row($columnas))
		{
		    $tipo_dato=$row[0];
		    $columna=$row[1];
		    $relacion=$row[2];
		    $orden=$row[3];
		    $tabla=$row[4];
		    $nombre_nulo=$row[5];
		    $sql_tablas=mysql_query("SELECT Nombre FROM SIS_Tablas where id=$tabla");
		    while ($row = mysql_fetch_row($sql_tablas))
		    {
		        $tablas=$row[0];
		    }
		    //============================================================================================================
		    //Valor Entero
		    //============================================================================================================
		    if($tipo_dato==0)
		    { 
		        echo '<input type="number" name="valor" placeholder="  Ingrese Valor" id="valor" class="text1" required>';
		    }
		    //============================================================================================================
		    //Valor Fecha
		    //============================================================================================================
		    elseif($tipo_dato==1)
		    {
		        echo '<input type="date" name="valor" required placeholder="  Ingrese Valor" id="valor" class="text1" >';
		    }
		    //============================================================================================================
		    //Valor Varchar
		    //============================================================================================================
		    elseif ($tipo_dato==3) 
		    {
		        echo '<input type="text" name="valor" placeholder="  Ingrese Valor" id="valor" class="text1" >';
		    }
		    //============================================================================================================
		    //Valor Distinto
		    //============================================================================================================
		    elseif ($tipo_dato==4) 
		    {    
		        echo '<select multiple="multiple"  name="valor" id="valor" data-width="100%">';
		        $result=mysql_query("SELECT $columna FROM $tablas GROUP BY $columna");
		        while($row=mysql_fetch_array($result))
		        { 
		            $valor=$row[0];
		            if($valor==NULL)
		            {
		                echo "<option value='$valor'>&nbsp;$nombre_nulo</option>";

		            }
		            else 
		            {
		                echo "<option value='$valor'>&nbsp;$valor</option>";                
		            }    
		        }
		        echo '</select>';
				echo '<script src="../js/multiple.js"></script>';
				echo '<script>';
                echo "$('#valor').multipleSelect({";
                echo 'isOpen: true,';
                echo 'keepOpen: true';
                echo '});';
                echo '</script>';
		    }
		    //============================================================================================================
		    //Relacion con Otra Tabla
		    //============================================================================================================
		    elseif ($tipo_dato==5) 
		    {    
		        echo '<select multiple="multiple"  name="valor" id="valor" data-width="100%">';
		        $result=mysql_query("SELECT * FROM $relacion ORDER BY $orden ASC");
		        while($row=mysql_fetch_array($result))
		        { 
		            echo "<option value='$row[0]'>&nbsp;$row[1]</option>";
		        }
		        echo '</select>';
				echo '<script src="../js/multiple.js"></script>';
				echo '<script>';
                echo "$('#valor').multipleSelect({";
                echo 'isOpen: true,';
                echo 'keepOpen: true';
                echo '});';
                echo '</script>';
				
		    }
		}    
	}
	public function asignarRelacion($tablas,$id_estrategia,$columnas,$logica,$valor,$siguiente_nivel,$nombre_nivel,$id_clases)
	{
		$this->tablas=$tablas;
		$this->id_estrategia=$id_estrategia;
		$this->columnas=$columnas;
		$this->logica=$logica;
		$this->valor=$valor;
		$this->siguiente_nivel=$siguiente_nivel;
		$this->nombre_nivel=$nombre_nivel;
		$this->id_clases=$id_clases;
	}
	public function mostrarRelacion()
	{
		//--------------------TABLAS----------------------
		$sql=mysql_query("SELECT * FROM SIS_Tablas WHERE id=$this->tablas");
		while($row=mysql_fetch_array($sql))
		{
		    $tablas=$row[1];
		}
		//--------------------COLUMNAS Y TIPO DE DATO : 0 INT - DATE, 1 STRING----------------------     
		$sql=mysql_query("SELECT columna,tipo,nulo FROM SIS_Columnas WHERE id=$this->columnas");
		while($row=mysql_fetch_array($sql))
		{
		    $columnas=$row[0];
		    $tipo=$row[1];
		    $nulo=$row[2];
		}
		$valor = $valor=$this->valor;
		     

		//-----------------------Creacion de Querys Dinamicas-------------------
		    $constante = "SELECT Rut FROM Persona WHERE Rut IN ";
		    $constanteNot = "SELECT Rut FROM Persona WHERE NOT Rut IN ";

		    $constanteDeuda = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE Persona.Rut IN ";
		    $constanteDeudaNot = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE NOT Persona.Rut IN ";

		    if($nulo==1)
		    {
		      $subQuery = "(SELECT Rut FROM $tablas WHERE $columnas IS NULL)";
		      $subQueryDeuda = "(SELECT Rut FROM $tablas WHERE $columnas IS NULL) AND Persona.Rut = Deuda.Rut";
		    }
		    else
		    {  
				$or_array = explode(",", $valor);
				$or_count = count($or_array);
				if($or_count>0)
				{
					$m=0;
					while($m<$or_count)
					{
						
						if ($tipo==0)
		    			{  
							$or_query = $columnas." ".$this->logica." ".$or_array[$m]." OR ".$or_query;
						}
						else
						{
							$or_query = $columnas." ".$this->logica." ".'"'.$or_array[$m].'"'." OR ".$or_query;
						}
						
						$m++;
					}
					$or_query = substr($or_query, 0, -4);
					$subQuery = "(SELECT Rut FROM $tablas WHERE $or_query)";
					$subQueryDeuda = "(SELECT Rut FROM $tablas WHERE $or_query) AND Persona.Rut = Deuda.Rut";
				}
				else
				{
					$subQuery = "(SELECT Rut FROM $tablas WHERE $columnas $this->logica $valor)";
					$subQueryDeuda = "(SELECT Rut FROM $tablas WHERE $columnas $this->logica  $valor) AND Persona.Rut = Deuda.Rut";
				}
		    }

		//-----------------------QUERY 1-------------------

		    $query1 = $constante.$subQuery;

		    $queryDeuda = $constanteDeuda.$subQueryDeuda;
		    $queryDeudaNot = $constanteDeudaNot.$subQueryDeuda;

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
		    $monto_1 = '$  '.number_format($monto_1, 0, "", ".");

		//-----------------------QUERY 2-------------------


		    $query2 = $constanteNot.$subQuery;
		    $query_2=mysql_query($query2);
		    while($row2=mysql_fetch_array($query_2))
		      {
		        $a=$row2['Rut'];
		      }
		    $numero2 = mysql_num_rows($query_2);
		    $numero2 = number_format($numero2, 0, "", ".");
		    $monto2 = mysql_query($queryDeudaNot);     
		    while($row=mysql_fetch_assoc($monto2))
		      {
		        $monto_2= $monto_2 + $row['Monto_Mora'];
		      }
		    $monto_2 = '$  '.number_format($monto_2, 0, "", ".");

		$matriz1 = "SELECT Rut FROM Persona WHERE  Rut IN ";
		$matrizDeuda1 = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE Persona.Rut IN ";
		$matriz2 = "SELECT Rut FROM Persona WHERE NOT Rut IN ";
		$matrizDeuda2 = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE NOT Persona.Rut IN ";

		mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,monto,cola,columna,condicion,matriz,matriz_deuda) VALUES('$query1',$this->id_estrategia,'$numero','$monto_1','$this->nombre_nivel','$subQuery','','$matriz1','$matrizDeuda1')");
		mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,monto,cola,columna,condicion,matriz,matriz_deuda) VALUES('$query2',$this->id_estrategia,'$numero2','$monto_2','No Seleccionado','$subQuery','NOT','$matriz2','$matrizDeuda2')");

		$query_id1=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query1' AND id_estrategia=$this->id_estrategia");
		$query_id2=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query2' AND id_estrategia=$this->id_estrategia");
		while($row=mysql_fetch_array($query_id1)){

			$id1=$row['id'];
		}

		while($row=mysql_fetch_array($query_id2)){

			$id2=$row['id'];
		}
		$array = array('first' => "<tr id='$id1'><td><i class='psi-folder-open' id='b$id1'  style='display: none;'></i> $this->nombre_nivel</td><td><center>$numero</center></td><td><center>$monto_1</center></td><td><center><a class='subestrategia'  id='d$id1'  href='#'><i class='fa fa-sitemap'></i></a> </center></td><td><center><a   href='test2.php?id=$id1'><i class='psi-download-from-cloud'></i></a> </center></td></tr><tr id='$id2'><td><i class='psi-folder-open' id='b$id2'  style='display: none;'></i> No Seleccionado</td><td><center>$numero2</center></td><td><center>$monto_2</center></td><td><center><a href='#' class='subestrategia' id='d$id2'><i class='fa fa-sitemap'></i></a></center></td><td><center><a   href='test2.php?id=$id2'><i class='psi-download-from-cloud'></i></a> </center></td></tr>", 'second' => "<input type='hidden' value='$id1' id='id_clases' name='id_clases'>");
		echo json_encode($array);
	}
	public function asignarRelacionDos($tablas,$id_estrategia,$columnas,$logica,$valor,$siguiente_nivel,$nombre_nivel,$id_clases)
	{
		$this->tablas=$tablas;
		$this->id_estrategia=$id_estrategia;
		$this->columnas=$columnas;
		$this->logica=$logica;
		$this->valor=$valor;
		$this->siguiente_nivel=$siguiente_nivel;
		$this->nombre_nivel=$nombre_nivel;
		$this->id_clases=$id_clases;
	}
	public function mostrarRelacionDos()
	{
		$sql=mysql_query("SELECT  * FROM SIS_Tablas WHERE id='$tablas'");
		while($row=mysql_fetch_array($sql))
		{
		  $tablas=$row[1];
		}
		
		$sqlColumnas=mysql_query("SELECT columna,tipo,nulo FROM SIS_Columnas WHERE id='$columnas'");
		while($row=mysql_fetch_array($sqlColumnas))
		{
		  $columnasQuery=$row[0];
		  $tipo=$row[1]; 
		  $nulo=$row[2]; 
		}   
		
		//==================================================================================================================
		// Si Tipo == 0 es un INT y si es 1 es de tipo STRING
		//==================================================================================================================
		
		if ($tipo==0)
		{     
		  $valor=$valor;
		}
		else 
		{
		  $valor = '"'.$valor.'"';
		} 
		
		//==================================================================================================================
		// Colsulta Condicion NOT o en blanco  al principio de la Query Estrategia
		//==================================================================================================================
		
		$queryCondicion=mysql_query("SELECT condicion,matriz,matriz_deuda FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$id_estrategia");
		while($row3=mysql_fetch_array($queryCondicion))
		{
		  $condicionFinal = $row3[0];   
		  $constante= $row3[1];  
		  $constanteDeuda= $row3[2];  
		}  
		
		//==================================================================================================================
		// Creacion de Querys Dinamicas QUERY 1
		//==================================================================================================================
		
			
		  
		$count=0;
		$condicion_x='';
		if($nulo==1)
		{
		  $columnas3 = "(SELECT Rut FROM $tablas WHERE $columnasQuery IS NULL)";
		}
		else
		{  
		  $columnas3 = "(SELECT Rut FROM $tablas WHERE $columnasQuery $logica $valor)";
		}
		$condicion=" AND ".$condicion_x." Persona.Rut IN ".$columnas3;
		$array_central = array();
		array_push($array_central, $condicion);
		$querya=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$id_estrategia");
		while($row=mysql_fetch_array($querya))
		{
		  $id_subquery = $row[0]; 
		  $count++;
		  if ($id_subquery==0)
		  {
			$condicion=$row[2];
			array_push($array_central, $condicion);
		  }
		  else
		  {
			$condicion=" AND ".$row[1]." Persona.Rut IN ".$row[2];
			array_push($array_central, $condicion);
		  }
		  while($id_subquery!=0)
		  {
			$queryb=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$id_estrategia");    
			while($row=mysql_fetch_array($queryb))
			{
			  $id_subquery = $row[0]; 
			  $count++;
			  if ($id_subquery==0)
			  {
				$condicion=$row[2];
				array_push($array_central, $condicion);
			  }
			  else
			  { 
				$condicion=" AND ".$row[1]." Persona.Rut IN ".$row[2];
				array_push($array_central, $condicion);
			  }
			}
		  }
		}
		
		$count = count($array_central);
		$i=0;
		$k=$count-1;
		$subQuery='';
		while($i<$count)
		{
		  $subQuery = $subQuery.$array_central[$k];
		  $i++; 
		  $k--;
		}
		
		//==================================================================================================================
		// Calcula Cantidad de Registros de  QUERY 1
		//==================================================================================================================
		
		$query1 = $constante.$subQuery;
		$query_1=mysql_query($query1);
		while($row2=mysql_fetch_array($query_1))
		{
		  $a=$row2['Rut'];
		}
		$numero = mysql_num_rows($query_1);
		$numero = number_format($numero, 0, "", ".");
		
		//==================================================================================================================
		// Calcula Monto Mora de QUERY 1
		//==================================================================================================================
		
		$queryDeuda = $constanteDeuda.$subQuery." AND Persona.Rut = Deuda.Rut";
		$monto1 = mysql_query($queryDeuda);     
		while($row=mysql_fetch_assoc($monto1))
		{
		  $monto_1= $monto_1 + $row['Monto_Mora'];
		}
		$monto_1 = '$  '.number_format($monto_1, 0, "", ".");
		
		//==================================================================================================================
		// Creacion de Querys Dinamicas QUERY 2
		//==================================================================================================================
		
		$id_subquery=$siguiente_nivel;
		$count=0;
		$condicion_x=' NOT ';
		if($nulo==1)
		{
		$columnas2 = "(SELECT Rut FROM $tablas WHERE $columnasQuery IS NULL)";
		}
		else
		{
		  $columnas2 = "(SELECT Rut FROM $tablas WHERE $columnasQuery $logica $valor)";
		}  
		$condicion=" AND ".$condicion_x." Persona.Rut IN ".$columnas2;
		$array_central2 = array();
		array_push($array_central2, $condicion);
		$queryc=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$id_estrategia");
		while($row=mysql_fetch_array($queryc))
		{
		  $id_subquery = $row[0]; 
		  $count++;
		  if ($id_subquery==0)
		  {
			$condicion=$row[2];
			array_push($array_central2, $condicion);
		  }
		  else
		  {
			$condicion=" AND ".$row[1]." Persona.Rut IN ".$row[2];
			array_push($array_central2, $condicion);
		  }
		  while($id_subquery!=0)
		  {
			$queryd=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$id_estrategia");    
			while($row=mysql_fetch_array($queryd))
			{
			  $id_subquery = $row[0]; 
			  $count++;
			  if ($id_subquery==0)
			  {
				$condicion=$row[2];
				array_push($array_central2, $condicion);
			  }
			  else
			  { 
				$condicion=" AND ".$row[1]." Persona.Rut IN ".$row[2];
				array_push($array_central2, $condicion);
			  }
			}
		  }
		}
		
		$count = count($array_central2);
		$i=0;
		$k=$count-1;
		$subQuery2='';
		while($i<$count)
		{
		  $subQuery2 = $subQuery2.$array_central2[$k];
		  $i++; 
		  $k--;
		}
		
		//==================================================================================================================
		// Calcula Cantidad de Registros de  QUERY 2
		//==================================================================================================================
		
		$query2 = $constante.$subQuery2;
		$query_2=mysql_query($query2);
		while($row2=mysql_fetch_array($query_2))
		{
		  $a=$row2['Rut'];
		}
		$numero2 = mysql_num_rows($query_2);
		$numero2 = number_format($numero2, 0, "", ".");
		
		//==================================================================================================================
		// Calcula Monto Mora de QUERY 2
		//==================================================================================================================
		
		$queryDeuda2 = $constanteDeuda.$subQuery2." AND Persona.Rut = Deuda.Rut";
		$monto2 = mysql_query($queryDeuda2);     
		while($row=mysql_fetch_assoc($monto2))
		{
		  $monto_2= $monto_2 + $row['Monto_Mora'];
		}
		$monto_2 = '$  '.number_format($monto_2, 0, "", ".");
		
		//==================================================================================================================
		// Si Querys no devuelven resultados
		//==================================================================================================================
		
		if (empty($monto_1))
		{ 
		  $monto_1=0;
		}
		if (empty($monto_2))
		{ 
		  $monto_2=0;
		}
		
		//==================================================================================================================
		// Algotimo de Generacion de Espacios
		//==================================================================================================================
		
		$query_espacios=mysql_query("SELECT  espacios FROM SIS_Querys WHERE id='$nivel' AND id_estrategia='$id_estrategia' LIMIT 1");
		while($row=mysql_fetch_array($query_espacios))
		{
		  $num_espacios=$row[0];
		}
		$num_espacios=$num_espacios+1;
		$espacios_total=$num_espacios*5;
		$espacios1='&nbsp;';
		$i=1;
		while($i<$espacios_total)
		{
		  $espacios=$espacios.$espacios1;
		  $i++;
		}
		
		//==================================================================================================================
		// Guardar Querys
		//==================================================================================================================
		mysql_query("UPDATE SIS_Querys SET carpeta=1,sub=0,eliminar=0 WHERE id='$siguiente_nivel' AND id_estrategia='$id_estrategia'");
		mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,id_subquery,monto,cola,columna,condicion,matriz,matriz_deuda,espacios) VALUES('$query1','$id_estrategia','$numero','$siguiente_nivel','$monto_1','$nombre_nivel','$columnas3','','$constante','$constanteDeuda','$num_espacios')");
		mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,id_subquery,monto,cola,columna,condicion,matriz,matriz_deuda,espacios) VALUES('$query2','$id_estrategia','$numero2','$siguiente_nivel','$monto_2','No Seleccionado','$columnas2','NOT','$constante','$constanteDeuda','$num_espacios')");
		
		//==================================================================================================================
		// ID para Metodo AJAX
		//==================================================================================================================
		
		$query_id1=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query1' AND id_estrategia='$id_estrategia'");
		$query_id2=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query2' AND id_estrategia='$id_estrategia'");
		while($row=mysql_fetch_array($query_id1)){
			$id1=$row['id'];
		}
		
		while($row=mysql_fetch_array($query_id2)){
		
			$id2=$row['id'];
		}
		
		
		//==================================================================================================================
		// Tablas para Metodo AJAX
		//==================================================================================================================
		
		$array = array('uno' => "<tr id='$id1'><td>$espacios<i class='fa fa-folder-open' id='b$id1'  style='display: none;'></i> $nombre_nivel</td><td><center>$numero</center></td><td><center>$monto_1</center></td><td><center><a href='#' class='subestrategia$id_clases' ><i class='fa fa-sitemap' id='d$id1'></i></a></center></td><td><center><a   href='test2.php?id=$id1'><i class='psi-download-from-cloud'></i></a> </center></td></tr><tr id='$id2'><td>$espacios <i class='fa fa-folder-open' id='b$id2'  style='display: none;'></i> No Seleccionado</td><td><center>$numero2</center></td><td><center>$monto_2</center></td><td><center><a href='#' class='subestrategia$id_clases' ><i class='fa fa-sitemap' id='d$id2'></i></a></center></td><td><center><a   href='test2.php?id=$id2'><i class='psi-download-from-cloud'></i></a> </center></td></tr>", 'dos' => "<input type='hidden' value='$id1' id='id_clases' name='id_clases'>", 'tres' => "$error");
		echo json_encode($array);
	}
	public function crearEstrategia($nombre_estrategia,$tipo_estrategia,$comentario,$fecha,$hora,$usuario)
	{
		$this->nombre_estrategia=$nombre_estrategia;
		$this->tipo_estrategia=$tipo_estrategia;
		$this->comentario=$comentario;
		$this->fecha=$fecha;
		$this->hora=$hora;
		$this->usuario=$usuario;

		$query=mysql_query("INSERT INTO SIS_Estrategias(nombre,comentario,fecha,hora,usuario,tipo) VALUES('$this->nombre_estrategia','$this->comentario','$this->fecha','$this->hora','$this->usuario','$this->tipo_estrategia')");
		$query1=mysql_query("SELECT id FROM SIS_Estrategias WHERE nombre='$this->nombre_estrategia'");
		while($row=mysql_fetch_array($query1))
		{
			$id_estrategia=$row['id'];

		}
		$array = array('uno' => "<input type='hidden' value='$id_estrategia' id='id_estrategia' name='id_estrategia'>", 'dos' => "$id_estrategia");
		echo json_encode($array);
	
	}
		
}
?>