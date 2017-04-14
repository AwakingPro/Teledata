<?php
include("../../db/db.php");
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
		  		$logic = '<select name="logica" class="select1" id="logica">';
			    $logic .= '<option value="0">Seleccione Lógica</option><option value="<">';
				$logic .= 'Menor</option><option value=">">Mayor</option><option value="=">';
				$logic .= 'Igual</option><option value="<=">Menor o Igual</option>';
				$logic .= '<option value=">=">Mayor o Igual</option><option value="!=">Distinto</option></select>';
				echo $logic;	
			}
			else
			{
		  		$logic = "<select name='logica' class='select1' id='logica'><option value='0'>";
				$logic .= "Seleccione Lógica</option><option value='='>Igual</option>";
				$logic .= "<option value='!=''>Distinto</option></select>";
				echo $logic;
			    
			}
		}
	}
	public function asignarValor($idv)
	{
		$this->idv=$idv;
	}
	public function mostrarValor()
	{
		$qc = "SELECT tipo_dato,columna,relacion,orden,id_tabla,nombre_nulo FROM SIS_Columnas where id=$this->idv";
		$columnas=mysql_query($qc);
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
				echo '<script src="../../js/multiple.js"></script>';
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
				echo '<script src="../../js/multiple.js"></script>';
				echo '<script>';
                echo "$('#valor').multipleSelect({";
                echo 'isOpen: true,';
                echo 'keepOpen: true';
                echo '});';
                echo '</script>';
				
		    }
		}    
	}
	public function asignarRelacion($tablas,$id_estrategia,$columnas,$logica,$valor,$siguiente_nivel,$nombre_nivel,$id_clases,$cedente)
	{
		$this->tablas=$tablas;
		$this->id_estrategia=$id_estrategia;
		$this->columnas=$columnas;
		$this->logica=$logica;
		$this->valor=$valor;
		$this->siguiente_nivel=$siguiente_nivel;
		$this->nombre_nivel=$nombre_nivel;
		$this->id_clases=$id_clases;
		$this->cedente=$cedente;
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
		    $constante_dist = "SELECT Rut FROM Persona WHERE NOT Rut IN ";
		    $constanteNot = "SELECT Rut FROM Persona WHERE NOT Rut IN ";
		    $constanteNot_dist = "SELECT Rut FROM Persona WHERE Rut IN ";

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
					$subQuery = "(SELECT Rut FROM $tablas WHERE $or_query AND FIND_IN_SET(\'$this->cedente\',Id_Cedente) )  AND FIND_IN_SET(\'$this->cedente\',Id_Cedente)";
					$subQuery4 = "(SELECT Rut FROM $tablas WHERE $or_query AND FIND_IN_SET('$this->cedente',Id_Cedente) )  AND FIND_IN_SET('$this->cedente',Id_Cedente)";
					$subQueryDeuda = "(SELECT Rut FROM $tablas WHERE $or_query AND FIND_IN_SET(\'$this->cedente\',Id_Cedente)) AND Persona.Rut = Deuda.Rut AND FIND_IN_SET(\'$this->cedente\',Persona.Id_Cedente)";
					$subQueryDeuda4 = "(SELECT Rut FROM $tablas WHERE $or_query AND FIND_IN_SET('$this->cedente',Id_Cedente)) AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
				}
				else
				{
					$subQuery = "(SELECT Rut FROM $tablas WHERE $columnas $this->logica $valor AND Id_Cedente = $this->cedente) AND Id_Cedente = $this->cedente";
					$subQueryDeuda = "(SELECT Rut FROM $tablas WHERE $columnas $this->logica  $valor Deuda.Id_Cedente = $this->cedente ) AND Persona.Rut = Deuda.Rut AND Deuda.Id_Cedente = $this->cedente ";
				}
		    }

		//-----------------------QUERY 1-------------------

		    if($this->logica == "!=")
		    {	
		    	$query1 = $constante_dist.$subQuery;
		    	$query10 = $constante_dist.$subQuery4;
		    	$query2 = $constanteNot_dist.$subQuery;
		    	$query20 = $constanteNot_dist.$subQuery4;
		    	$matriz1 = "SELECT Rut FROM Persona WHERE NOT  Rut IN ";
				$matrizDeuda1 = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE NOT Persona.Rut IN  ";
				$matriz2 = "SELECT Rut FROM Persona WHERE  Rut IN ";
				$matrizDeuda2 = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE  Persona.Rut IN ";
			}
			else
			{
				$query1 = $constante.$subQuery;
				$query10 = $constante.$subQuery4;
				$query2 = $constanteNot.$subQuery;
		    	$query20 = $constanteNot.$subQuery4;
		    	$matriz1 = "SELECT Rut FROM Persona WHERE  Rut IN ";
				$matrizDeuda1 = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE Persona.Rut IN ";
				$matriz2 = "SELECT Rut FROM Persona WHERE NOT Rut IN ";
				$matrizDeuda2 = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE NOT Persona.Rut IN ";

			}	
		    


		    $queryDeuda = $constanteDeuda.$subQueryDeuda4;
		    $queryDeudaNot = $constanteDeudaNot.$subQueryDeuda4;

		    $query_1=mysql_query($query10);
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


		    
		    $query_2=mysql_query($query20);
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

		
		

		mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,monto,cola,columna,condicion,matriz,matriz_deuda,Id_Cedente) VALUES('$query1',$this->id_estrategia,'$numero','$monto_1','$this->nombre_nivel','$subQuery','','$matriz1','$matrizDeuda1',$this->cedente)");
		mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,monto,cola,columna,condicion,matriz,matriz_deuda,Id_Cedente) VALUES('$query2',$this->id_estrategia,'$numero2','$monto_2','No Seleccionado','$subQuery','NOT','$matriz2','$matrizDeuda2',$this->cedente)");

		$query_id1=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query1' AND id_estrategia=$this->id_estrategia");
		$query_id2=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query2' AND id_estrategia=$this->id_estrategia");
		while($row=mysql_fetch_array($query_id1)){

			$id1=$row['id'];
		}

		while($row=mysql_fetch_array($query_id2)){

			$id2=$row['id'];
		}
		$array = array('first' => "<tr id='$id1'><td><i class='psi-folder-open' id='b$id1'  style='display: none;'></i> $this->nombre_nivel</td><td><center>$numero</center></td><td><center>$monto_1</center></td><td><center><select class='cambiar_prioridadjs' id='p$id1'><option value=1>Sin Prioridad</option><option value=2>Baja+</option><option value=3>Baja++</option><option value=4>Media+</option><option value=5>Media++</option><option value=6>Alta+</option><option value=7>Alta++</option></select></center></td><td><center><a class='subestrategia'  id='d$id1'  href='#'><i class='fa fa-sitemap'></i></a> </center></td><td><center><a   href='test2.php?id=$id1'><i class='psi-download-from-cloud'></i></a> </center></td></tr><tr id='$id2'><td><i class='psi-folder-open' id='b$id2'  style='display: none;'></i> No Seleccionado</td><td><center>$numero2</center></td><td><center>$monto_2</center></td><td><center><select class='cambiar_prioridadjs' id='p$id2'><option value=1>Sin Prioridad</option><option value=2>Baja+</option><option value=3>Baja++</option><option value=4>Media+</option><option value=5>Media++</option><option value=6>Alta+</option><option value=7>Alta++</option></select></center></td><td><center><a href='#' class='subestrategia' id='d$id2'><i class='fa fa-sitemap'></i></a></center></td><td><center><a   href='test2.php?id=$id2'><i class='psi-download-from-cloud'></i></a> </center></td></tr>", 'second' => "<input type='hidden' value='$id1' id='id_clases' name='id_clases'>");
		echo json_encode($array);
	}
	public function mostrarRelacionDos()
	{
		$sql=mysql_query("SELECT  * FROM SIS_Tablas WHERE id=$this->tablas");
		while($row=mysql_fetch_array($sql))
		{
		  $tablas=$row[1];
		}
		
		$sqlColumnas=mysql_query("SELECT columna,tipo,nulo FROM SIS_Columnas WHERE id=$this->columnas");
		while($row=mysql_fetch_array($sqlColumnas))
		{
		  $columnasQuery=$row[0];
		  $tipo=$row[1]; 
		  $nulo=$row[2]; 
		}   
		
		//==================================================================================================================
		// Si Tipo == 0 es un INT y si es 1 es de tipo STRING
		//==================================================================================================================
		
		$valor = $this->valor;
		$id_subquery=$this->siguiente_nivel;
		$id_estrategia = $this->id_estrategia;
		$nivel = $this->siguiente_nivel;
		
		//==================================================================================================================
		// Colsulta Condicion NOT o en blanco  al principio de la Query Estrategia
		//==================================================================================================================
		
		$queryCondicion=mysql_query("SELECT condicion,matriz,matriz_deuda,matriz_not,matriz_deuda_not FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$this->id_estrategia");
		while($row3=mysql_fetch_array($queryCondicion))
		{
		  	$condicionFinal = $row3[0]; 
		  	if($this->logica == "!=")
			{ 
				$constante= $row3[3];  
		 		$constanteDeuda= $row3[4];
			} 
			else
			{
				$constante= $row3[1];  
		  		$constanteDeuda= $row3[2];
			}	
		      
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
		  $or_array = explode(",", $valor);
				$or_count = count($or_array);
				if($or_count>0)
				{
					$m=0;
					while($m<$or_count)
					{
						
						if ($tipo==0)
		    			{  
							$or_query = $columnasQuery." ".$this->logica." ".$or_array[$m]." OR ".$or_query;
						}
						else
						{
							$or_query = $columnasQuery." ".$this->logica." ".'"'.$or_array[$m].'"'." OR ".$or_query;
						}
						
						$m++;
					}
					$or_query = substr($or_query, 0, -4);
					$columnas3 = "(SELECT Rut FROM $tablas WHERE $or_query AND FIND_IN_SET('$this->cedente',Id_Cedente)) AND FIND_IN_SET('$this->cedente',Id_Cedente)";
					
				}
				else
				{
					$columnas3 = "(SELECT Rut FROM $tablas WHERE $columnasQuery $this->logica $valor ) ";

				}
		}

		if($this->logica == "!=")
		{
			$condicion=" AND ".$condicion_x." NOT Persona.Rut IN ".$columnas3;
		}	
		else 
		{
			$condicion=" AND ".$condicion_x." Persona.Rut IN ".$columnas3;
		}	
		
		
		$array_central = array();
		array_push($array_central, $condicion);
		$querya=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$this->id_estrategia");
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
		  	if($this->logica == "!=")
			{
				$condicion=" AND ".$row[1]." NOT Persona.Rut IN ".$row[2];
			}
			else
			{
				$condicion=" AND ".$row[1]." Persona.Rut IN ".$row[2];
			}	
			array_push($array_central, $condicion);
			
		  }
		  while($id_subquery!=0)
		  {
			$queryb=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$this->id_estrategia");    
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
			  	if($this->logica == "!=")
				{
					$condicion=" AND ".$row[1]." NOT Persona.Rut IN ".$row[2];
				}
				else
				{
					$condicion=" AND ".$row[1]." Persona.Rut IN ".$row[2];
				}	
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
		
		$queryDeuda = $constanteDeuda.$subQuery." AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
		$monto1 = mysql_query($queryDeuda);     
		while($row=mysql_fetch_assoc($monto1))
		{
		  $monto_1= $monto_1 + $row['Monto_Mora'];
		}
		$monto_1 = '$  '.number_format($monto_1, 0, "", ".");
		
		//==================================================================================================================
		// Creacion de Querys Dinamicas QUERY 2
		//==================================================================================================================
		
		$id_subquery=$this->siguiente_nivel;
		$count=0;
		$condicion_x=' NOT ';
		if($this->logica == "!=")
		{
			$condicion=" AND ".$condicion_x." NOT Persona.Rut IN ".$columnas3;
		}
		else
		{
			$condicion=" AND ".$condicion_x." Persona.Rut IN ".$columnas3;
		}	
		$array_central2 = array();
		array_push($array_central2, $condicion);
		$queryc=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$this->id_estrategia");
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
		  	if($this->logica == "!=")
			{	
				$condicion=" AND ".$row[1]." NOT Persona.Rut IN ".$row[2];
			}
			else
			{
				$condicion=" AND ".$row[1]." Persona.Rut IN ".$row[2];
			}	
			array_push($array_central2, $condicion);
		  }
		  while($id_subquery!=0)
		  {
			$queryd=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$this->id_estrategia");    
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
			  	if($this->logica == "!=")
				{	
					$condicion=" AND ".$row[1]." NOT Persona.Rut IN ".$row[2];
				}
				else
				{
					$condicion=" AND ".$row[1]." Persona.Rut IN ".$row[2];
				}	
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
		
		$queryDeuda2 = $constanteDeuda.$subQuery2." AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
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
		
		$query_espacios=mysql_query("SELECT  espacios FROM SIS_Querys WHERE id='$nivel' AND id_estrategia='$this->id_estrategia' LIMIT 1");
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
		$columnas3 = addslashes($columnas3);
		$query1 = addslashes($query1);
		$query2 = addslashes($query2);
		//==================================================================================================================
		// Guardar Querys
		//==================================================================================================================
		mysql_query("UPDATE SIS_Querys SET carpeta=1,sub=0,eliminar=0 WHERE id='$this->siguiente_nivel' AND id_estrategia='$this->id_estrategia'");
		mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,id_subquery,monto,cola,columna,condicion,matriz,matriz_deuda,espacios,Id_Cedente) VALUES('$query1','$this->id_estrategia','$numero','$this->siguiente_nivel','$monto_1','$this->nombre_nivel','$columnas3','','$constante','$constanteDeuda','$num_espacios',$this->cedente)");
		mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,id_subquery,monto,cola,columna,condicion,matriz,matriz_deuda,espacios,Id_Cedente) VALUES('$query2','$this->id_estrategia','$numero2','$this->siguiente_nivel','$monto_2','No Seleccionado','$columnas3','NOT','$constante','$constanteDeuda','$num_espacios',$this->cedente)");
		
		//==================================================================================================================
		// ID para Metodo AJAX
		//==================================================================================================================
		
		$query_id1=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query1' AND id_estrategia='$this->id_estrategia'");
		$query_id2=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query2' AND id_estrategia='$this->id_estrategia'");
		while($row=mysql_fetch_array($query_id1)){
			$id1=$row['id'];
		}
		
		while($row=mysql_fetch_array($query_id2)){
		
			$id2=$row['id'];
		}
		
		
		//==================================================================================================================
		// Tablas para Metodo AJAX
		//==================================================================================================================
		
		$array = array('uno' => "<tr id='$id1'><td>$espacios<i class='fa fa-folder-open' id='b$id1'  style='display: none;'></i> $this->nombre_nivel</td><td><center>$numero</center></td><td><center>$monto_1</center></td><td><center><select class='cambiar_prioridadj$this->id_clases' id='p$id1'><option value=1>Sin Prioridad</option><option value=2>Baja+</option><option value=3>Baja++</option><option value=4>Media+</option><option value=5>Media++</option><option value=6>Alta+</option><option value=7>Alta++</option></select></center></td><td><center><a href='#' class='subestrategia$this->id_clases' ><i class='fa fa-sitemap' id='d$id1'></i></a></center></td><td><center><a   href='test2.php?id=$id1'><i class='psi-download-from-cloud'></i></a> </center></td></tr><tr id='$id2'><td>$espacios <i class='fa fa-folder-open' id='b$id2'  style='display: none;'></i> No Seleccionado</td><td><center>$numero2</center></td><td><center>$monto_2</center></td><td><center><select class='cambiar_prioridadj$this->id_clases' id='p$id2'><option value=1>Sin Prioridad</option><option value=2>Baja+</option><option value=3>Baja++</option><option value=4>Media+</option><option value=5>Media++</option><option value=6>Alta+</option><option value=7>Alta++</option></select></center></td><td><center><a href='#' class='subestrategia$this->id_clases' ><i class='fa fa-sitemap' id='d$id2'></i></a></center></td><td><center><a   href='test2.php?id=$id2'><i class='psi-download-from-cloud'></i></a> </center></td></tr>", 'dos' => "<input type='hidden' value='$id1' id='id_clases' name='id_clases'>", 'tres' => "$error");
		echo json_encode($array);
	}
	public function crearEstrategia($nombre_estrategia,$tipo_estrategia,$comentario,$fecha,$hora,$usuario,$cedente)
	{
		$this->nombre_estrategia=$nombre_estrategia;
		$this->tipo_estrategia=$tipo_estrategia;
		$this->comentario=$comentario;
		$this->fecha=$fecha;
		$this->hora=$hora;
		$this->usuario=$usuario;
		$this->cedente=$cedente;

		$query=mysql_query("INSERT INTO SIS_Estrategias(nombre,comentario,fecha,hora,usuario,tipo,Id_Cedente) VALUES('$this->nombre_estrategia','$this->comentario','$this->fecha','$this->hora','$this->usuario','$this->tipo_estrategia',$this->cedente)");
		$query1=mysql_query("SELECT id FROM SIS_Estrategias WHERE nombre='$this->nombre_estrategia'");
		while($row=mysql_fetch_array($query1))
		{
			$id_estrategia=$row['id'];

		}
		$array = array('uno' => "<input type='hidden' value='$id_estrategia' id='id_estrategia' name='id_estrategia'>", 'dos' => "$id_estrategia");
		echo json_encode($array);
	
	}
	public function asignarPrioridad($id_prioridad,$valor_prioridad)
	{
		$this->id_prioridad=$id_prioridad;
		$this->valor_prioridad=$valor_prioridad;
		$update= "UPDATE SIS_Querys SET prioridad='$this->valor_prioridad' WHERE id=$this->id_prioridad";
		$mysql_update=mysql_query($update);
		echo $this->id_prioridad;
	}
	public function asignarComentario($id_com,$valor_com)
	{
		$this->id_com=$id_com;
		$this->valor_com=$valor_com;
		$update= "UPDATE SIS_Querys SET comentario='$this->valor_com' WHERE id=$this->id_com";
		$mysql_update=mysql_query($update);
		echo $this->id_com;
	}
	public function asignarCategoria($dias_hoy,$gestiones_hoy,$categoria,$tipo_contacto_hoy,$logica,$tipo_contacto_historico,$gestiones_historicas,$dias_historicas)
	{
		$this->dias_hoy=$dias_hoy;
		$this->dias_historicas=$dias_historicas;
		$this->logica=$logica;
		$this->gestiones_hoy=$gestiones_hoy;
		$this->categoria=$categoria;
		$this->gestiones_historicas=$gestiones_historicas;
		$this->tipo_contacto_hoy=$tipo_contacto_hoy;
		$tipo_contacto_hoy_array = explode(",", $this->tipo_contacto_hoy);
		$or_count = count($tipo_contacto_hoy_array);
		if($or_count>0)
		{
			$m=0;
			while($m<$or_count)
			{
				$id_tipo = "Id_TipoGestion=";
				$or_tipo_hoy  = $id_tipo.$tipo_contacto_hoy_array[$m]." OR ".$or_tipo_hoy;
				$m++;
			}
			$or_tipo_hoy = substr($or_tipo_hoy , 0, -3);
		}
		else
		{
			$or_tipo_hoy = "Id_TipoGestion=".$this->tipo_contacto_hoy;
		}
		$this->tipo_contacto_historico=$tipo_contacto_historico;
		$tipo_contacto_historico_array = explode(",", $this->tipo_contacto_historico);
		$or_count_h = count($tipo_contacto_historico_array);
		if($or_count_h>0)
		{
			$n=0;
			while($n<$or_count_h)
			{
				$id_tipo = "Id_TipoGestion=";
				$or_tipo_historico  = $id_tipo.$tipo_contacto_historico_array[$n]." OR ".$or_tipo_historico;
				$n++;
			}
			$or_tipo_historico = substr($or_tipo_historico , 0, -3);
		}
		else
		{
			$or_tipo_historico = "Id_TipoGestion=".$this->tipo_contacto_historico;
		}
		
		
		$update_fono= "UPDATE SIS_Arbol_Fono SET fecha_actual=$this->dias_hoy ,cantidad_gestiones_hoy = $this->gestiones_hoy, id_tipo_hoy='$or_tipo_hoy',logica=$this->logica ,id_tipo_historico='$or_tipo_historico',cantidad_gestiones_historicas=$this->gestiones_historicas,fecha_historica=$this->dias_historicas,categoria=$this->categoria";
		$mysql_update_fono=mysql_query($update_fono);
		$salida = shell_exec("java -jar /var/www/java/Main.jar");
		$silver = mysql_query("SELECT count(color) FROM Fono WHERE color=4");
		$silver = mysql_result($silver, 0);
		$query_silver = mysql_query("UPDATE SIS_grafico_fonos SET cant=$silver WHERE id_color=4");
		$update_silver = mysql_query($query_silver);
		$green = mysql_query("SELECT count(color) FROM Fono WHERE color=1");
		$green = mysql_result($green, 0);
		$query_green = mysql_query("UPDATE SIS_grafico_fonos SET cant=$green WHERE id_color=1");
		$update_green = mysql_query($query_green);
		$yellow = mysql_query("SELECT count(color) FROM Fono WHERE color=2");
		$yellow= mysql_result($yellow, 0);
		$query_yellow= mysql_query("UPDATE SIS_grafico_fonos SET cant=$yellow WHERE id_color=2");
		$update_yellow = mysql_query($query_yellow);
		$red= mysql_query("SELECT count(color) FROM Fono WHERE color=3");
		$red= mysql_result($red, 0);
		$query_red= mysql_query("UPDATE SIS_grafico_fonos SET cant=$red WHERE id_color=3");
		$update_red= mysql_query($query_red);
		echo "ok";
	}
}
?>