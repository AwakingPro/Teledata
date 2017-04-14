
<?php
include("../../db/db.php");
class Estrategia
{
	function __construct(){
		if(!isset($_SESSION)){
			session_start();
		}
	}
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
		        $result=mysql_query("SELECT $columna FROM $tablas  GROUP BY $columna");
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
				echo '<script src="../../../js/multiple.js"></script>';
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
		        $result=mysql_query("SELECT * FROM $relacion group by $columna  ORDER BY $orden ASC ");
		        while($row=mysql_fetch_array($result))
		        {
		            echo "<option value='$row[0]'>&nbsp;".utf8_encode($row[1])."</option>";
		        }
		        echo '</select>';
				echo '<script src="../../../js/multiple.js"></script>';
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
		    $rel = $row[3];
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

		if ($this->logica == "!=")
		{
			$this->logica = "=";
			$constante = "SELECT Rut FROM Persona WHERE NOT Rut IN ";
		    $constanteNot = "SELECT Rut FROM Persona WHERE  Rut IN ";
		    $constanteDeuda = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE NOT Persona.Rut IN ";
		    $constanteDeudaNot = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE  Persona.Rut IN ";

		}
		else
		{
			$constante = "SELECT Rut FROM Persona WHERE Rut IN ";
		    $constanteNot = "SELECT Rut FROM Persona WHERE NOT Rut IN ";
		    $constanteDeuda = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE Persona.Rut IN ";
		    $constanteDeudaNot = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE NOT Persona.Rut IN ";
		}




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
					if($rel == 0)
					{
						$subQuery = "(SELECT Rut FROM $tablas WHERE $or_query)  AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
						$subQueryDeuda = "(SELECT Rut FROM $tablas WHERE $or_query) AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
					}
					else if($rel == 1)
					{
						$subQuery = "(SELECT Rut FROM $tablas WHERE $or_query AND Id_Cedente = $this->cedente)  AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
						$subQueryDeuda = "(SELECT Rut FROM $tablas WHERE $or_query AND Id_Cedente = $this->cedente) AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
					}
					else
					{
						$subQuery = "(SELECT Rut FROM $tablas WHERE $or_query AND FIND_IN_SET('$this->cedente',Id_Cedente))  AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
						$subQueryDeuda = "(SELECT Rut FROM $tablas WHERE $or_query AND FIND_IN_SET('$this->cedente',Id_Cedente)) AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
					}

				}
				else
				{

					if($rel == 0)
					{
						$subQuery = "(SELECT Rut FROM $tablas WHERE $columnas $this->logica $valor ) AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
						$subQueryDeuda = "(SELECT Rut FROM $tablas WHERE $columnas $this->logica  $valor ) AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente) ";
					}
					else if($rel == 1)
					{
						$subQuery = "(SELECT Rut FROM $tablas WHERE $columnas $this->logica $valor AND Id_Cedente = $this->cedente) AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
						$subQueryDeuda = "(SELECT Rut FROM $tablas WHERE $columnas $this->logica  $valor AND Id_Cedente = $this->cedente) AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente) ";
					}
					else
					{
						$subQuery = "(SELECT Rut FROM $tablas WHERE $columnas $this->logica $valor AND FIND_IN_SET('$this->cedente',Id_Cedente)) AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
						$subQueryDeuda = "(SELECT Rut FROM $tablas WHERE $columnas $this->logica  $valor AND FIND_IN_SET('$this->cedente',Id_Cedente)) AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente) ";
					}

				}


		//-----------------------QUERY 1-------------------


				$query1 = $constante.$subQuery;
				$query2 = $constanteNot.$subQuery;
		    	$matriz1 = $constante;
				$matrizDeuda1 = $constanteDeuda;
				$matriz2 = $constanteNot;
				$matrizDeuda2 = $constanteDeudaNot;



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


		$subQuery = addslashes($subQuery);
		$query1 = addslashes($query1);
		$query2 = addslashes($query2);
		$queryDeuda = addslashes($queryDeuda);
		$queryDeudaNot = addslashes($queryDeudaNot);



		mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,monto,cola,columna,condicion,matriz,matriz_deuda,Id_Cedente,query_deuda) VALUES('$query1',$this->id_estrategia,'$numero','$monto_1','$this->nombre_nivel','$subQuery','','$matriz1','$matrizDeuda1',$this->cedente,'$queryDeuda')");
		mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,monto,cola,columna,condicion,matriz,matriz_deuda,Id_Cedente,query_deuda) VALUES('$query2',$this->id_estrategia,'$numero2','$monto_2','No Seleccionado','$subQuery','NOT','$matriz2','$matrizDeuda2',$this->cedente,'$queryDeudaNot')");

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
		  $rel = $row[3];
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
		$id_subquery_inicial=$this->siguiente_nivel;
		$id_estrategia = $this->id_estrategia;
		$nivel = $this->siguiente_nivel;

		//==================================================================================================================
		// Colsulta Condicion NOT o en blanco  al principio de la Query Estrategia
		//==================================================================================================================

		$queryCondicion=mysql_query("SELECT condicion,matriz,matriz_deuda FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$this->id_estrategia");
		while($row3=mysql_fetch_array($queryCondicion))
		{
		  	$condicionFinal = $row3[0];
			$constante= $row3[1];
		  	$constanteDeuda= $row3[2];

		}

		//==================================================================================================================
		// Creacion de Querys Dinamicas QUERY 1
		//==================================================================================================================
		$r = 0;
		if ($this->logica == "!=")
		{
			$r = 1;
		}
		else
		{
			$r = 0;
		}

		$count = 0;
		$condicion_x = '';
		$or_array = explode(",", $valor);
		$or_count = count($or_array);
		if($or_count > 0)
		{
			$m=0;
			while($m<$or_count)
			{
				if ($tipo == 0)
		    	{
					if($r == 1)
					{
						$or_query = $columnasQuery." "."="." ".$or_array[$m]." OR ".$or_query;
					}
					else
					{
						$or_query = $columnasQuery." ".$this->logica." ".$or_array[$m]." OR ".$or_query;
					}
				}
				else
				{
					if($r == 1)
					{
						$or_query = $columnasQuery." "."="." ".'"'.$or_array[$m].'"'." OR ".$or_query;
					}
					else
					{
						$or_query = $columnasQuery." ".$this->logica." ".'"'.$or_array[$m].'"'." OR ".$or_query;
					}
				}

				$m++;
			}
			$or_query = substr($or_query, 0, -4);
			if($rel == 0)
			{
				$columnas = "(SELECT Rut FROM $tablas WHERE $or_query) AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
				$columnasDeuda = "(SELECT Rut FROM $tablas WHERE $or_query) AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
			}
			else if($rel == 1)
			{
				$columnas = "(SELECT Rut FROM $tablas WHERE $or_query AND Id_Cedente = $this->cedente)  AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
				$columnasDeuda = "(SELECT Rut FROM $tablas WHERE $or_query AND Id_Cedente = $this->cedente) AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";

			}
			else
			{
				$columnas = "(SELECT Rut FROM $tablas WHERE $or_query AND FIND_IN_SET('$this->cedente',Id_Cedente))  AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
				$columnasDeuda = "(SELECT Rut FROM $tablas WHERE $or_query AND FIND_IN_SET('$this->cedente',Id_Cedente))  AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
			}
		}
		else
		{
			if($rel == 0)
			{
				$columnas = "(SELECT Rut FROM $tablas WHERE $columnasQuery $this->logica $valor ) AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
				$columnasDeuda = "(SELECT Rut FROM $tablas WHERE $columnasQuery $this->logica $valor )  AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";

			}
			else if($rel == 1)
			{
				$columnas = "(SELECT Rut FROM $tablas WHERE $columnasQuery $this->logica $valor AND Id_Cedente = $this->cedente) AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
				$columnasDeuda = "(SELECT Rut FROM $tablas WHERE $columnasQuery $this->logica $valor AND Id_Cedente = $this->cedente)  AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";

			}
			else
			{
				$columnas = "(SELECT Rut FROM $tablas WHERE $columnasQuery $this->logica $valor AND FIND_IN_SET('$this->cedente',Id_Cedente)) AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
				$columnasDeuda = "(SELECT Rut FROM $tablas WHERE $columnasQuery $this->logica $valor AND FIND_IN_SET('$this->cedente',Id_Cedente))  AND Persona.Rut = Deuda.Rut AND FIND_IN_SET('$this->cedente',Persona.Id_Cedente)";
			}

		}


		if($r == 1)
		{
		  	$matriz=" AND NOT Rut IN ";
		  	$matrizNot=" AND Rut IN ";
		  	$matrizDeuda=" AND NOT Persona.Rut IN ";
		  	$matrizDeudaNot=" AND  Persona.Rut IN ";
		}
		else
		{
			$matriz =" AND Rut IN ";
			$matrizNot = " AND NOT Rut IN ";
			$matrizDeuda=" AND Persona.Rut IN ";
			$matrizDeudaNot=" AND NOT Persona.Rut IN ";
		}
		$condicion = $matriz.$columnas;



		$array_central = array();
		array_push($array_central, $condicion);
		$query_armar=mysql_query("SELECT id_subquery,matriz, columna FROM SIS_Querys WHERE  id=$id_subquery_inicial AND id_estrategia=$this->id_estrategia");
		while($row=mysql_fetch_array($query_armar))
		{
			$id_subquery = $row[0];
			$matriz_armar = $row[1];
			$columna_armar = $row[2];
			$count++;
		  	if ($id_subquery==0)
		  	{
				$condicion=$matriz_armar.$columna_armar;
				array_push($array_central, $condicion);
		  	}
		  	else
		  	{

				$condicion=$matriz_armar.$columna_armar;
				array_push($array_central, $condicion);

		  	}
		  	while($id_subquery!=0)
		  	{
				$queryb=mysql_query("SELECT id_subquery,matriz ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$this->id_estrategia");
				while($row=mysql_fetch_array($queryb))
				{
			  		$id_subquery = $row[0];
					$matriz_armar = $row[1];
					$columna_armar = $row[2];
			 		$count++;
			  		if ($id_subquery==0)
			  		{
						$condicion=$matriz_armar.$columna_armar;
						array_push($array_central, $condicion);
			  		}
			  		else
			  		{

						$condicion=$matriz_armar.$columna_armar;
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




		//____________________________________________________________________________________________________________________

		$condicion_not = $matrizNot.$columnas;



		$array_central_not = array();
		array_push($array_central_not, $condicion_not);
		$query_armar_not=mysql_query("SELECT id_subquery,matriz, columna FROM SIS_Querys WHERE  id=$id_subquery_inicial AND id_estrategia=$this->id_estrategia");
		while($row=mysql_fetch_array($query_armar_not))
		{
			$id_subquery = $row[0];
			$matriz_armar = $row[1];
			$columna_armar = $row[2];
			$count++;
		  	if ($id_subquery==0)
		  	{
				$condicion_not=$matriz_armar.$columna_armar;
				array_push($array_central_not, $condicion_not);
		  	}
		  	else
		  	{

				$condicion_not=$matriz_armar.$columna_armar;
				array_push($array_central_not, $condicion_not);

		  	}
		  	while($id_subquery!=0)
		  	{
				$querybnot=mysql_query("SELECT id_subquery,matriz ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$this->id_estrategia");
				while($row=mysql_fetch_array($querybnot))
				{
			  		$id_subquery = $row[0];
					$matriz_armar = $row[1];
					$columna_armar = $row[2];
			 		$count++;
			  		if ($id_subquery==0)
			  		{
						$condicion_not=$matriz_armar.$columna_armar;
						array_push($array_central_not, $condicion_not);
			  		}
			  		else
			  		{

						$condicion_not=$matriz_armar.$columna_armar;
						array_push($array_central_not, $condicion_not);
			  		}
				}
		  	}
		}

		$count = count($array_central_not);
		$i=0;
		$k=$count-1;
		$subQueryNot='';
		while($i<$count)
		{
		  $subQueryNot = $subQueryNot.$array_central_not[$k];
		  $i++;
		  $k--;
		}

		$query2 = $subQueryNot;
		$query_2=mysql_query($query2);
		while($row=mysql_fetch_array($query_2))
		{
		    $a=$row['Rut'];
		}
		$numero2 = mysql_num_rows($query_2);
		$numero2 = number_format($numero2, 0, "", ".");

        //____________________________________________________________________________________________________________________


		$count = 0;
		$condicion_deuda = $matrizDeuda.$columnasDeuda;
		$array_central_deuda = array();
		array_push($array_central_deuda, $condicion_deuda);
		$query_armar_deuda=mysql_query("SELECT id_subquery,matriz_deuda, columna FROM SIS_Querys WHERE  id=$id_subquery_inicial AND id_estrategia=$this->id_estrategia");
		while($row4=mysql_fetch_array($query_armar_deuda))
		{
			$id_subquery = $row4[0];
			$matriz_armar = $row4[1];
			$columna_armar = $row4[2];
			$count++;
		  	if ($id_subquery==0)
		  	{
				$condicion_deuda=$matriz_armar.$columna_armar;
				array_push($array_central_deuda, $condicion_deuda);
		  	}
		  	else
		  	{

				$condicion_deuda=$matriz_armar.$columna_armar;
				array_push($array_central_deuda, $condicion_deuda);

		  	}
		  	while($id_subquery!=0)
		  	{
				$querybdeuda=mysql_query("SELECT id_subquery,matriz_deuda ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$this->id_estrategia");
				while($row=mysql_fetch_array($querybdeuda))
				{
			  		$id_subquery = $row[0];
					$matriz_armar = $row[1];
					$columna_armar = $row[2];
			 		$count++;
			  		if ($id_subquery==0)
			  		{
						$condicion_deuda=$matriz_armar.$columna_armar;
						array_push($array_central_deuda, $condicion_deuda);
			  		}
			  		else
			  		{

						$condicion_deuda=$matriz_armar.$columna_armar;
						array_push($array_central_deuda, $condicion_deuda);
			  		}
				}
		  	}
		}




		$count2 = count($array_central_deuda);
		$i1=0;
		$ka=$count2-1;
		$subQueryDeuda='';
		while($i1<$count2)
		{
		  $subQueryDeuda = $subQueryDeuda.$array_central_deuda[$ka];
		  $i1++;
		  $ka--;
		}



		$query1 = $subQuery;
		$query_1=mysql_query($query1);
		while($row2=mysql_fetch_array($query_1))
		{
		    $a=$row2['Rut'];
		}
		$numero = mysql_num_rows($query_1);
		$numero = number_format($numero, 0, "", ".");


		$queryDeuda = $subQueryDeuda;
		$monto1 = mysql_query($queryDeuda);
		while($row=mysql_fetch_assoc($monto1))
		{
		    $monto_1= $monto_1 + $row['Monto_Mora'];
		}
		$monto_1 = '$  '.number_format($monto_1, 0, "", ".");



		$count = 0;
		$condicion_deuda_not = $matrizDeudaNot.$columnasDeuda;
		$array_central_deuda_not = array();
		array_push($array_central_deuda_not, $condicion_deuda_not);
		$query_armar_deuda_not=mysql_query("SELECT id_subquery,matriz_deuda, columna FROM SIS_Querys WHERE  id=$id_subquery_inicial AND id_estrategia=$this->id_estrategia");
		while($row=mysql_fetch_array($query_armar_deuda_not))
		{
			$id_subquery = $row[0];
			$matriz_armar = $row[1];
			$columna_armar = $row[2];
			$count++;
		  	if ($id_subquery==0)
		  	{
				$condicion_deuda_not=$matriz_armar.$columna_armar;
				array_push($array_central_deuda_not, $condicion_deuda_not);
		  	}
		  	else
		  	{

				$condicion_deuda_not=$matriz_armar.$columna_armar;
				array_push($array_central_deuda_not, $condicion_deuda_not);

		  	}
		  	while($id_subquery!=0)
		  	{
				$querybdeuda_not=mysql_query("SELECT id_subquery,matriz_deuda ,columna FROM SIS_Querys WHERE id=$id_subquery AND id_estrategia=$this->id_estrategia");
				while($row=mysql_fetch_array($querybdeuda_not))
				{
			  		$id_subquery = $row[0];
					$matriz_armar = $row[1];
					$columna_armar = $row[2];
			 		$count++;
			  		if ($id_subquery==0)
			  		{
						$condicion_deuda_not=$matriz_armar.$columna_armar;
						array_push($array_central_deuda_not, $condicion_deuda_not);
			  		}
			  		else
			  		{

						$condicion_deuda_not=$matriz_armar.$columna_armar;
						array_push($array_central_deuda_not, $condicion_deuda_not);
			  		}
				}
		  	}
		}




		$count2 = count($array_central_deuda_not);
		$i1=0;
		$ka=$count2-1;
		$subQueryDeudaNot='';
		while($i1<$count2)
		{
		  $subQueryDeudaNot = $subQueryDeudaNot.$array_central_deuda_not[$ka];
		  $i1++;
		  $ka--;
		}
		$queryDeudaNot = $subQueryDeudaNot;
		$monto2 = mysql_query($queryDeudaNot);
		while($row=mysql_fetch_assoc($monto2))
		{
		    $monto_2= $monto_2 + $row['Monto_Mora'];
		}
		$monto_2 = '$  '.number_format($monto_2, 0, "", ".");

		//==================================================================================================================

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

		$columnas = addslashes($columnas);
		$matriz = addslashes($matriz);
		$matrizDeuda = addslashes($matrizDeuda);
		$query1 = addslashes($query1);
		$query2 = addslashes($query2);
		$queryDeuda = addslashes($queryDeuda);
		$queryDeudaNot = addslashes($queryDeudaNot);
		$matrizNot = addslashes($matrizNot);
		$matrizDeudaNot = addslashes($matrizDeudaNot);
		//$query2 = addslashes($query2);
		//==================================================================================================================
		// Guardar Querys
		//==================================================================================================================
		mysql_query("UPDATE SIS_Querys SET carpeta=1,sub=0,eliminar=0 WHERE id='$this->siguiente_nivel' AND id_estrategia='$this->id_estrategia'");
		mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,id_subquery,monto,cola,columna,condicion,matriz,matriz_deuda,espacios,Id_Cedente,query_deuda) VALUES('$query1','$this->id_estrategia','$numero','$this->siguiente_nivel','$monto_1','$this->nombre_nivel','$columnas','','$matriz','$matrizDeuda','$num_espacios',$this->cedente,'$queryDeuda')");
		mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,id_subquery,monto,cola,columna,condicion,matriz,matriz_deuda,espacios,Id_Cedente,query_deuda) VALUES('$query2','$this->id_estrategia','$numero2','$this->siguiente_nivel','$monto_2','No Seleccionado','$columnas','NOT','$matrizNot','$matrizDeudaNot','$num_espacios',$this->cedente,'$queryDeudaNot')");

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
	public function crearEstrategia($nombre_estrategia,$tipo_estrategia,$comentario,$fecha,$hora,$usuario,$cedente,$idUsuario)
	{
		$this->nombre_estrategia=$nombre_estrategia;
		$this->tipo_estrategia=$tipo_estrategia;
		$this->comentario=$comentario;
		$this->fecha=$fecha;
		$this->hora=$hora;
		$this->usuario=$usuario;
		$this->cedente=$cedente;
		$this->idUsuario=$idUsuario;

		$query=mysql_query("INSERT INTO SIS_Estrategias(nombre,comentario,fecha,hora,usuario,tipo,Id_Cedente,Id_Usuario) VALUES('$this->nombre_estrategia','$this->comentario','$this->fecha','$this->hora','$this->usuario','$this->tipo_estrategia',$this->cedente,$this->idUsuario)");
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
	public function asignarCola($id_cola,$valor_cola)
	{
		$this->id_cola=$id_cola;
		$this->valor_cola=$valor_cola;
		$update= "UPDATE SIS_Querys SET cola='$this->valor_cola' WHERE id=$this->id_cola";
		$mysql_update=mysql_query($update);
		echo $this->id_cola;
	}
	public function asignarCategoria($color,$tipo_contacto,$dias,$cant1,$cond1,$logica,$cant2,$cond2,$w,$mundo)
	{

		$this->color=$color;
		$this->tipo_contacto=$tipo_contacto;
		$this->dias=$dias;
		$this->cant1=$cant1;
		$this->cond1=$cond1;
		$this->logica=$logica;
		$this->cant2=$cant2;
		$this->cond2=$cond2;
		$this->w=$w;
		$this->mundo=$mundo;
		$query_color = mysql_query("SELECT * FROM SIS_Categoria_Fonos WHERE color = $this->color AND mundo = $this->mundo");
		if(mysql_num_rows($query_color) > 0)
		{
			echo "2";
		}
		else
		{
			$tipo_contacto_array = explode(",", $this->tipo_contacto);
			$or_count = count($tipo_contacto_array);
			if($or_count>0)
			{
				$m=0;
				while($m<$or_count)
				{
					$id_tipo = "Id_TipoGestion=";
					$or_tipo_hoy  = $id_tipo.$tipo_contacto_array[$m]." OR ".$or_tipo_hoy;
					$m++;
				}
				$or_tipo_hoy = substr($or_tipo_hoy , 0, -3);
			}
			else
			{
				$or_tipo_hoy = "Id_TipoGestion=".$this->tipo_contacto;
			}




			$tipo_contacto_array2 = explode(",", $this->tipo_contacto);
			$or_count2 = count($tipo_contacto_array2);
			if($or_count2>0)
			{
				$m2=0;
				while($m2<$or_count2)
				{
					$tipo = $tipo_contacto_array2[$m2];
					$query_tipo = mysql_query("SELECT Nombre FROM Tipo_Contacto WHERE Id_TipoContacto = $tipo");
					while($row = mysql_fetch_array($query_tipo))
					{
						$nombre_tipo = $row['Nombre'];
					}
					$or_tipo_hoy2  = $nombre_tipo." -- ".$or_tipo_hoy2;
					$m2++;
				}
				$or_tipo_hoy2 = substr($or_tipo_hoy2 , 0, -3);
			}
			else
			{
				$query_tipo = mysql_query("SELECT Nombre FROM Tipo_Contacto WHERE Id_TipoContacto = $this->tipo_contacto");
				while($row = mysql_fetch_array($query_tipo))
				{
						$nombre_tipo = $row['Nombre'];
				}
				$or_tipo_hoy2 = $nombre_tipo;
			}





			$color_hexa=mysql_query("SELECT color,nombre FROM SIS_Colores WHERE id='$this->color'");
			while($row=mysql_fetch_array($color_hexa))
			{
				$color_hex=$row['color'];
				$color_nombre=$row['nombre'];

			}



			$update_fono= "INSERT INTO SIS_Categoria_Fonos(color,tipo_contacto,tipo_contacto_query, dias, cond1, cant1, logica, cond2, cant2, w , color_hex ,color_nombre , tipo_var , mundo) VALUES ('$this->color','$this->tipo_contacto','$or_tipo_hoy','$this->dias','$this->cond1','$this->cant1','$this->logica','$this->cond2','$this->cant2','$this->w' ,'$color_hex','$color_nombre','$or_tipo_hoy2','$this->mundo')";
			mysql_query($update_fono);

			echo "1";
		}

	}

	public function asignarCategoriaIvr($color,$tipo_contacto,$dias,$cant1,$cond1,$logica,$cant2,$cond2,$w,$mundo)
	{

		$this->color=$color;
		$this->tipo_contacto=$tipo_contacto;
		$this->dias=$dias;
		$this->cant1=$cant1;
		$this->cond1=$cond1;
		$this->logica=$logica;
		$this->cant2=$cant2;
		$this->cond2=$cond2;
		$this->w=$w;
		$this->mundo=$mundo;

		$query_color = mysql_query("SELECT * FROM SIS_Categoria_Fonos WHERE color = $this->color AND mundo = $this->mundo ");
		if(mysql_num_rows($query_color) > 0)
		{
			echo "2";
		}
		else
		{
			$tipo_contacto_array = explode(",", $this->tipo_contacto);
			$or_count = count($tipo_contacto_array);
			if($or_count>0)
			{
				$m=0;
				while($m<$or_count)
				{
					$id_tipo = "Id_TipoGestion=";
					$or_tipo_hoy  = $id_tipo.$tipo_contacto_array[$m]." OR ".$or_tipo_hoy;
					$m++;
				}
				$or_tipo_hoy = substr($or_tipo_hoy , 0, -3);
			}
			else
			{
				$or_tipo_hoy = "Id_TipoGestion=".$this->tipo_contacto;
			}




			$tipo_contacto_array2 = explode(",", $this->tipo_contacto);
			$or_count2 = count($tipo_contacto_array2);
			if($or_count2>0)
			{
				$m2=0;
				while($m2<$or_count2)
				{
					$tipo = $tipo_contacto_array2[$m2];
					$query_tipo = mysql_query("SELECT Nombre FROM Tipo_Contacto WHERE Id_TipoContacto = $tipo");
					while($row = mysql_fetch_array($query_tipo))
					{
						$nombre_tipo = $row['Nombre'];
					}
					$or_tipo_hoy2  = $nombre_tipo." -- ".$or_tipo_hoy2;
					$m2++;
				}
				$or_tipo_hoy2 = substr($or_tipo_hoy2 , 0, -3);
			}
			else
			{
				$query_tipo = mysql_query("SELECT Nombre FROM Tipo_Contacto WHERE Id_TipoContacto = $this->tipo_contacto");
				while($row = mysql_fetch_array($query_tipo))
				{
						$nombre_tipo = $row['Nombre'];
				}
				$or_tipo_hoy2 = $nombre_tipo;
			}





			$color_hexa=mysql_query("SELECT color,nombre FROM SIS_Colores WHERE id='$this->color'");
			while($row=mysql_fetch_array($color_hexa))
			{
				$color_hex=$row['color'];
				$color_nombre=$row['nombre'];

			}



			$update_fono= "INSERT INTO SIS_Categoria_Fonos(color,tipo_contacto,tipo_contacto_query, dias, cond1, cant1, logica, cond2, cant2, w , color_hex ,color_nombre , tipo_var , mundo) VALUES ('$this->color','$this->tipo_contacto','$or_tipo_hoy','$this->dias','$this->cond1','$this->cant1','$this->logica','$this->cond2','$this->cant2','$this->w' ,'$color_hex','$color_nombre','$or_tipo_hoy2','$this->mundo')";
			mysql_query($update_fono);

			echo "1";
		}

	}
		// $salida = shell_exec("java -jar /var/www/java/Main.jar");
		// $silver = mysql_query("SELECT count(color) FROM Fono WHERE color=4");
		// $silver = mysql_result($silver, 0);
		// $query_silver = mysql_query("UPDATE SIS_grafico_fonos SET cant=$silver WHERE id_color=4");
		// $update_silver = mysql_query($query_silver);
		// $green = mysql_query("SELECT count(color) FROM Fono WHERE color=1");
		// $green = mysql_result($green, 0);
		// $query_green = mysql_query("UPDATE SIS_grafico_fonos SET cant=$green WHERE id_color=1");
		// $update_green = mysql_query($query_green);
		// $yellow = mysql_query("SELECT count(color) FROM Fono WHERE color=2");
		// $yellow= mysql_result($yellow, 0);
		// $query_yellow= mysql_query("UPDATE SIS_grafico_fonos SET cant=$yellow WHERE id_color=2");
		// $update_yellow = mysql_query($query_yellow);
		// $red= mysql_query("SELECT count(color) FROM Fono WHERE color=3");
		// $red= mysql_result($red, 0);
		// $query_red= mysql_query("UPDATE SIS_grafico_fonos SET cant=$red WHERE id_color=3");
		// $update_red= mysql_query($query_red);
		// echo "ok";

	public function asignarCategoriaColor($color,$nombre,$comentario)
	{
		$this->color=$color;
		$this->nombre=$nombre;
		$this->comentario=$comentario;

		$querycolor = mysql_query("SELECT * FROM SIS_Colores WHERE color = '$this->color' OR  nombre = '$this->nombre'");
		if(mysql_num_rows($querycolor) > 0)
		{
			echo "2";
		}
		else
		{

			$update_color= "INSERT INTO SIS_Colores(color,nombre,comentario) VALUES ('$this->color','$this->nombre','$this->comentario')";
			mysql_query($update_color);
			echo "1";
		}

	}
	public function javaGet($data)
	{
		$proce=mysql_query("SELECT * FROM SIS_Procesos ");
		$count_pro = mysql_num_rows($proce);
		if($count_pro>0)
		{
			echo "1";
		}
		else
		{
			$salida = shell_exec('java -jar ColorFono.jar > /dev/null 2>&1 &');
			$ran = rand(1000, 3000);
			$proceso= "INSERT INTO SIS_Procesos(numero) VALUES ('$ran')";
			mysql_query($proceso);
			$proceso2= "UPDATE  SIS_Categoria_Fonos SET proceso='$ran'";
			mysql_query($proceso2);
			echo "2";
		}

	}
	public function javaGetIvr($data)
	{
		$proce=mysql_query("SELECT * FROM SIS_Procesos ");
		$count_pro = mysql_num_rows($proce);
		if($count_pro>0)
		{
			echo "1";
		}
		else
		{
			$salida = shell_exec('java -jar ColorIvr.jar > /dev/null 2>&1 &');
			$ran = rand(1000, 3000);
			$proceso= "INSERT INTO SIS_Procesos(numero) VALUES ('$ran')";
			mysql_query($proceso);
			$proceso2= "UPDATE  SIS_Categoria_Fonos SET proceso='$ran'";
			mysql_query($proceso2);
			echo "2";
		}

	}
	
	public function estrategiasGuardadas($cedente,$nombreUsuario)
	{
        $cedente = $this->cedente=$cedente;
		$IdEstrategia = '';
        $sql_num = mysql_query("SELECT * FROM SIS_Estrategias WHERE Id_Cedente = $cedente");
				if(mysql_num_rows($sql_num)>0)
        {
    		echo '<table id="TablaVerEstrategia" class="table table-striped table-bordered" cellspacing="0" width="100%">';
    		echo '<thead>';
    		echo '<tr>';
            echo '<th>Nombre Estrategia</th>';
            echo '<th class="min-desktop"><center>Hora Creacion</center></th>';
            echo '<th class="min-desktop"><center>Fecha Ceacion</center></th>';
            echo '<th class="min-desktop"><center>Creador</center></th>';
            echo '<th class="min-desktop"><center>Tipo</center></th>';
            echo '<th class="min-desktop"><center>Eliminar</center></th>';
            echo '<th class="min-desktop"><center>Ver</center></th>';
    		echo '</tr>';
    		echo '</thead>';
    		echo '<tbody>';

            $sql = mysql_query("SELECT * FROM SIS_Estrategias WHERE Id_Cedente = $cedente");
            while($row4=mysql_fetch_array($sql))
            {
                $IdEstrategia= $row4[0];
				$fecha_a = $row4[3];
                $fecha_a = date("d-m-Y", strtotime($fecha_a));
                echo "<td>$row4[1]</td>";
                echo "<td><center>$row4[4]</center></td>";
                echo "<td><center>$fecha_a</center></td>";
                echo '<td><center>';

                $usuariob = $row4[5];
                $sql_user = mysql_query("SELECT nombre FROM Usuarios WHERE usuario = '$usuariob'");
                while($row = mysql_fetch_array($sql_user))
                {
                    echo $row[0];
										// si el usuario conectado el mismo que creo la estrategia tiene derecho a eliminarla
										if ($nombreUsuario == $row[0])
										{
										  $visible = "";
										}
										else
										{
                      //$visible = "disabled='".$visible."'";
											$visible = "disabled='disabled'";
										}

                }

                echo '</center></td>';
                echo '<td><center>';

                $tipo = $row4[6];
                $sql_tipo = mysql_query("SELECT nombre FROM SIS_Tipo_Estrategia WHERE id = $tipo");
                while($row = mysql_fetch_array($sql_tipo))
                {
                    echo $row[0]; // <a style='$visible' href='delete.php?id_estrategia=$row4[0]'><i class='fa fa-trash'></i></a>
                } // <a href=''><button class='fa fa-search' disabled="disabled"></a></button>

                echo '</center></td>';
                echo "<td><center><a href='delete.php?id_estrategia=$row4[0]'><button class='fa fa-trash btn btn-danger btn-icon icon-lg' $visible ></button></a></center></td>";
                echo "<td><center><button class='fa fa-search btn btn-primary btn-icon VerEstrategia' id='$IdEstrategia'></button></center></td>";
                echo '</tr>';
            }
            echo '</tbody>';
    		echo '</table>';			
    	}
        else
        {
            echo "No hay estrategias creadas para este Cedente";
        }
	}

	public function SesionEstrategia($Id)
	{
		$this->Id=$Id;
		session_start();
		$_SESSION['IdEstrategia'] = $this->Id;
		session_start();
	}


	function getEstrategias($Cedente){
		$ToReturn = "";
		$Query = mysql_query("SELECT id,nombre FROM SIS_Estrategias WHERE Id_Cedente = '".$Cedente."'");
		$ToReturn .= '<option value="-1">TOTAL CARTERA</option>';
		while($row = mysql_fetch_assoc($Query))
		{
            $id = $row["id"];
            $nombre = $row["nombre"];
            $ToReturn .= "<option value='".$id."'>".$nombre."</option>";
		}
		return $ToReturn;
	}
	function getColas($Estrategia){
		$ToReturn = "";
		$Query = mysql_query("SELECT id,cola FROM SIS_Querys WHERE id_estrategia = '".$Estrategia."' AND terminal = 1");
		$ToReturn .= '<option value="-1">TOTAL CARTERA</option>';
		while($row = mysql_fetch_assoc($Query))
		{
            $id = $row["id"];
            $cola = $row["cola"];
            $ToReturn .= "<option value='".$id."'>".$cola."</option>";
		}
		return $ToReturn;
	}
	public function mostrarTabla($lista,$periodo)
	{
		$this->cedente = $_SESSION['cedente'];
		$this->lista = $lista;
		$this->periodo = $periodo;
		$qr = "QR_".$this->cedente."_".$this->lista;
		if($this->lista == -1)
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
		        echo "<td><button class='btn btn-icon icon-lg fa fa-plus-square nivel1 lvl1'  id='d$rid' value=''></button><span class='text-xs'>$rn</span></td>";
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


		        //$q5 = mysql_num_rows($q5);
				echo $r4 = mysql_num_rows($q4);
				echo "</td>";
				$ratio = $r4==0 ? number_format(0, 2, '.', '') : number_format($r3/$r4, 2, '.', '');
		        echo "<td>$ratio</td>";
		        $porcentaje = $total==0 ? number_format(0, 2, '.', '') : number_format(($r4/$total)*100, 2, '.', '');
		        echo "<td>$porcentaje %</td>";
		        echo "</tr>";
				$i++;
		    }
		    $sg = $total - $cg;
		    $psg = $total==0 ? number_format(0, 2, '.', '') : number_format(($sg/$total)*100, 2, '.', '');
		    echo "<tr>";
		    echo "<td><button class='btn btn-icon icon-lg fa fa-plus-square nivel1'  id='sg' value=''></button><span class='text-xs'>EN POBLAMIENTO DE DATOS</span></td>";
		    echo "<td>0</td>";
		    echo "<td>0</td>";
		    echo "<td>0.00</td>";
		    echo "<td>0 %</td>";
		    echo "</tr>";
		    echo "<tr>";
		    echo "<td><b>Total Periodo</b></td>";
		    $qt = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre WHERE cedente = $this->cedente and resultado in (1,2)");
		    $total_g = mysql_num_rows($qt);
		    echo "<td>$total_g</td>";
		    echo "<td>$total</td>";
		    $total_ratio = $total==0 ? number_format(0, 2, '.', '') : number_format($q5/$total, 2, '.', '');
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
		        echo "<td><button class='btn btn-icon icon-lg fa fa-plus-square nivel1 lvl1'  id='d$rid' value=''></button><span class='text-xs'>$rn</span></td>";
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


		        //$q5 = mysql_num_rows($q5);
				echo $r4 = mysql_num_rows($q4);
				echo "</td>";
				$ratio = $r4==0 ? number_format(0, 2, '.', '') : number_format($r3/$r4, 2, '.', '');
		        echo "<td>$ratio</td>";
		        $porcentaje = $total==0 ? number_format(0, 2, '.', '') : number_format(($r4/$total)*100, 2, '.', '');
		        echo "<td>$porcentaje %</td>";
		        echo "</tr>";
				$i++;
		    }
		    $sg = $total - $cg;
		    $psg = $total==0 ? number_format(0, 2, '.', '') : number_format(($sg/$total)*100, 2, '.', '');
		    $qt = mysql_query("SELECT rut_cliente FROM gestion_ult_semestre WHERE cedente = $this->cedente and resultado in (1,2)");
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
		    $total_ratio = $total==0 ? number_format(0, 2, '.', '') : number_format($q5/$total, 2, '.', '');
		    echo "<td>$total_ratio</td>";
		    echo "<td>100.00 %</td>";
		    echo "</tr></tbody></table>";
		    echo "<input type='hidden' id='cant_total' value='$total'>";
		}
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

	        	echo "<tr>";
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

	        	echo "<tr>";
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
