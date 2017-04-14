<?php
include("../../db/db.php");
class Tareas
{
	public function asignarTipo($id,$id_cedente)
	{
		$this->id=$id;
		$this->id_cedente=$id_cedente;
	}
	public function mostrarTipo()
	{
		$sql_estrategia = mysql_query("SELECT * FROM SIS_Estrategias WHERE  tipo=$this->id AND Id_Cedente = '$this->id_cedente'");
		if(mysql_num_rows($sql_estrategia)>0)
		{
			echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead><tr>';
            echo '<th>ID Estrategia</th>';
           	echo '<th>Nombre de la Estrategia</th>';
			echo '<th class="min-desktop"><center>Creador</center></th>';
			echo '<th class="min-desktop"><center>Hora</center></th>';
			echo '<th class="min-desktop"><center>Fecha</center></th>';
			echo '<th class="min-desktop"><center>Seleccionar</center></th></tr>';                               
            echo '</thead><tbody>';
			$j = 1;
            $sql_estrategia2 = mysql_query("SELECT * FROM SIS_Estrategias WHERE  tipo=$this->id AND Id_Cedente = '$this->id_cedente'");
            while($row=mysql_fetch_array($sql_estrategia2))
			{ 
            	echo "<tr id='$row[0]' class='$j'>";
             	echo "<td>$row[0]</td>";
			    echo "<td>$row[1]</td>";
			    echo "<td>$row[2]</td>";
			    echo "<td>$row[3]</td>";
			    echo "<td>$row[4]</td>";
                echo "<td><center><input type='checkbox' class='seleccione_estrategia' id='dos$j' />";
				echo "</center></td></td></tr>";
			    $j++;
             }
		echo "</tbody></table>";
        } 
		else 
		{
			echo "No hay estrategias creadas en el Tipo seleccionado.";
        }
	}
	public function asignarEstrategia($ide)
	{
		$this->ide=$ide;
	}
	public function mostrarEstrategia()
	{	
		$sql_num = mysql_query("SELECT id,cola,cantidad,monto,prioridad,comentario FROM SIS_Querys_Estrategias WHERE  id_estrategia=$this->ide AND terminal=1");
		if(mysql_num_rows($sql_num)>0)
		{
			echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
			echo '<thead><tr><th>ID Cola</th><th>Cola</th><th class="min-desktop"><center>Cantidad de Registros</center></th>';
			echo '<th class="min-desktop"><center>Monto</center></th><th class="min-desktop"><center>Prioridad</center></th>';
			echo '<th class="min-desktop"><center>Comentario</center></th><th class="min-desktop"><center>Descargar Fonos <br>por Categoria</center></th><th class="min-desktop"><center>Descargar IVR<br> por Categoria</center></th><th class="min-desktop"><center>Descargar <br>Consolidado</center></th><th class="min-desktop"><center>Activar</center></th><th class=""><center>Asignar</center></th>';
			echo '</tr></thead><tbody>';
			$k = 1;
			$sql_estrategia = mysql_query("SELECT id,cola,cantidad,monto,prioridad,comentario,discador FROM SIS_Querys_Estrategias WHERE  id_estrategia=$this->ide AND terminal=1");
			while($row=mysql_fetch_array($sql_estrategia))
			{ 
			
				$id_query = $row[0];
				$discador= $row[6];

				echo "<tr id='$row[0]' class='$k'>";
				echo "<td>$row[0]</td>";
				echo "<td>$row[1]</td>";
				echo "<td><center>$row[2]</center></td>";
				echo "<td><center>$row[3]</center></td>";
				echo "<td><center>$row[4]</center></td>";
				echo "<td><center>$row[5]</center></td>";
				echo "<td>"; 

				// $sql_id = mysql_query("SELECT query FROM SIS_Querys WHERE id = $id_query");
				// while($row=mysql_fetch_array($sql_id))
				// { 
				// 	$query_id = $row[0];
				// }	
				// $query_color_2 = "SELECT distinct fono_cob.color FROM fono_cob , Persona WHERE Persona.Rut IN (".$query_id.")  AND fono_cob.Rut = Persona.Rut ";
				// $query_color = mysql_query($query_color_2); 

				// $array_color = array();

				// while($row2=mysql_fetch_assoc($query_color))
				// { 
				// 	$color_q= $row2['color'];
				// 	array_push($array_color, $color_q);
				// }
				// $count_array=mysql_num_rows($query_color);

				// $i=0;
				// while($i < $count_array)
				// {
					
				// 	$id_color = $array_color[$i];
				// 	$cant_color1 = "SELECT fono_cob.color FROM fono_cob , Persona WHERE Persona.Rut IN (".$query_id.")  AND fono_cob.Rut = Persona.Rut AND fono_cob.color= $id_color";
				// 	$cant_color_query1=mysql_query($cant_color1);
				// 	$cant1 = mysql_num_rows($cant_color_query1);


				// 	$select = mysql_query("SELECT nombre, color FROM SIS_Colores WHERE id =$id_color ");
				// 	while($row=mysql_fetch_array($select))
				// 	{ 
				// 		$a= $row[0];
				// 		$b= $row[1];
				// 		echo "<a href='download_color.php?id=$id_query&color=$id_color'><i class='fa fa-arrow-circle-down fa-lg' style='color:$b'></i> - $cant1</a><br>";

				// 	}	


				// 	$i++;
				// }	

				echo "</td>";
				echo "<td>";

				// $query_color_22 = "SELECT distinct fono_cob.color_ivr FROM fono_cob , Persona WHERE Persona.Rut IN (".$query_id.")  AND fono_cob.Rut = Persona.Rut ";
				// $query_color2 = mysql_query($query_color_22); 

				// $array_color2 = array();

				// while($row3=mysql_fetch_assoc($query_color2))
				// { 
				// 	$color_i= $row3['color_ivr'];
				// 	array_push($array_color2, $color_i);
				// }
				// $count_array2=mysql_num_rows($query_color2);

				// $i2=0;
				// while($i2 < $count_array2)
				// {
					
				// 	$id_color2 = $array_color2[$i2];

				// 	$cant_color = "SELECT fono_cob.color_ivr FROM fono_cob , Persona WHERE Persona.Rut IN (".$query_id.")  AND fono_cob.Rut = Persona.Rut AND fono_cob.color_ivr = $id_color2";
				// 	$cant_color_query=mysql_query($cant_color);
				// 	$cant = mysql_num_rows($cant_color_query);

				// 	$select2 = mysql_query("SELECT nombre, color FROM SIS_Colores WHERE id =$id_color2 ");
				// 	while($row=mysql_fetch_array($select2))
				// 	{ 
				// 		$a2= $row[0];
				// 		$b2= $row[1];
				// 		echo "<a href='download_color_ivr.php?id=$id_query&color=$id_color2'><i class='fa fa-chevron-circle-down fa-lg' style='color:$b2'></i> - $cant</a><br>";

				// 	}	


				// 	$i2++;
				// }	

				echo "</td>";
				echo "<td><center><a href='download.php?id=$id_query'><i class='fa fa-download fa-lg'></i></a></center></td></td>";
				echo "<td><center>";
				$PuedeAsignar = "Disabled";
				if($discador==1)
				{	
					echo "<input  type='checkbox' checked  class='activar_cola'  value='1' id='k$id_query' />";
					$PuedeAsignar = "";
				}
				else
				{
					echo "<input  type='checkbox'   class='activar_cola'  value='0' id='k$id_query' />";
				}	
				$k++;
				echo "</center></td>";
				echo "<td class='AsignadorBtn'><center><i class='fa fa-download fa-lg Asignar ".$PuedeAsignar."'></i></center></td></tr>";
			}
			echo "</tbody></table>"; 
		}
		else
		{
			echo "No hay <b>colas terminales</b> en esta estrategia.";
		}
	}	
	public function activarCola($id)
	{
		$this->id=$id;
		$sel_cola = mysql_query("SELECT cola,query,Id_Cedente FROM SIS_Querys_Estrategias WHERE id=$this->id");
		while($row=mysql_fetch_array($sel_cola))
		{
			$nombre_cola = $row[0];
			$query = $row[1];
			$cedente= $row[2];

		}
		$prefijo = "QR_".$cedente."_".$this->id;
		$ver_prefijo= mysql_query("show tables like '$prefijo'");

 		if(mysql_num_rows ($ver_prefijo)>0)
 		{	
 			echo "1";
 		}
 		else
 		{	
			
			$fecha_traza = date('Y-m-d');
			$crear = "CREATE TABLE $prefijo (id INT NOT NULL AUTO_INCREMENT, Rut INT  ,llamado INT DEFAULT '0' ,KEY (id))";
			mysql_query($crear);
			mysql_query("INSERT INTO $prefijo (Rut) $query");
			//mysql_query("INSERT INTO Trazabilidad_Rut_Cola (Rut) SELECT Rut FROM $prefijo");
			//mysql_query("UPDATE Trazabilidad_Rut_Cola SET Cola_Trabajo='$nombre_cola' , Fecha_Traza='$fecha_traza',Prefijo='$prefijo' WHERE Cola_Trabajo IS NULL AND Fecha_Traza IS NULL");
			mysql_query("UPDATE SIS_Querys_Estrategias SET discador=1 WHERE id=$this->id");
			echo "0";
			echo $crear;
		}	
		
	}
	public function desactivarCola($id)
	{
		$this->id=$id;
		$sel_cola = mysql_query("SELECT cola,query,Id_Cedente FROM SIS_Querys_Estrategias WHERE id=$this->id");
		while($row=mysql_fetch_array($sel_cola))
		{
			$nombre_cola = $row[0];
			$query = $row[1];
			$cedente= $row[2];

		}
		$prefijo = "QR_".$cedente."_".$this->id;
		$ver_prefijo= mysql_query("show tables like '$prefijo'");

 		if(mysql_num_rows ($ver_prefijo)>0)
 		{	
 			
 			$query = "DROP TABLE $prefijo";
 			mysql_query($query);
 			mysql_query("UPDATE SIS_Querys_Estrategias SET discador=0 WHERE id=$this->id");
 			echo "1";
 		}
 		else
 		{
 			echo "0";
 		}
 	}

 	public function actualizarCola()
	{
		$query_discador = mysql_query("SELECT id,query,Id_Cedente,cola FROM SIS_Querys_Estrategias WHERE discador=1");
		while($row = mysql_fetch_array($query_discador))
		{
			$id = $row[0];
			$query = $row[1];
			$cedente = $row[2];
			$nombre_cola = $row[3];
			$prefijo = "QR_".$cedente."_".$id;
			echo $prefijo."<br>";
			//$query_drop = "DROP TABLE $prefijo";
 			//mysql_query($query_drop);
 			$fecha_traza = date('Y-m-d');
			//$crear = "CREATE TABLE $prefijo (id INT NOT NULL AUTO_INCREMENT, Rut INT  ,llamado INT DEFAULT '0' ,KEY (id))";
			//mysql_query($crear);
			mysql_query("INSERT IGNORE INTO $prefijo (Rut) $query");
			mysql_query("DELETE FROM $prefijo WHERE  NOT Rut IN ($query)");
			mysql_query("INSERT INTO Trazabilidad_Rut_Cola (Rut) SELECT Rut FROM $prefijo");
			mysql_query("UPDATE Trazabilidad_Rut_Cola SET Cola_Trabajo='$nombre_cola' , Fecha_Traza='$fecha_traza',Prefijo='$prefijo' WHERE Cola_Trabajo IS NULL AND Fecha_Traza IS NULL ");
			

		}	


	}
	function getEntidades($TipoEntidad, $Array){
		$db = new Db();
		$ToReturn = "";
		$In = "";
		switch($TipoEntidad){
			case '1':
				if($Array != ""){
					$In =  "and empresa_externa.IdEmpresaExterna not in (".$Array.")";
				}
				$sql = "select * from empresa_externa ".$In."";
				$Supervisores = $db->select($sql);
				foreach($Supervisores as $Supervisor){
					$ToReturn .= "<option value='EE_".$Supervisor["IdEmpresaExterna"]."'>".$Supervisor["Nombre"]."</option>";
				}
			break;
			case '2':
				if($Array != ""){
					$In =  "and Personal.Id_Personal not in (".$Array.")";
				}
				$ToReturn .= "<optgroup label='Supervisor'>";
					//echo $Array;
					//echo implode(",",$Array);
					$sql = "select Personal.* from Usuarios inner join Personal on Personal.Nombre_Usuario = Usuarios.usuario where Usuarios.nivel = '2' ".$In."";
					$Supervisores = $db->select($sql);
					foreach($Supervisores as $Supervisor){
						$ToReturn .= "<option value='S_".$Supervisor["Id_Personal"]."'>".$Supervisor["Nombre"]."</option>";
					}
				$ToReturn .= "</optgroup>";
				$ToReturn .= "<optgroup label='Ejecutivo'>";
					$sql = "select Personal.* from Usuarios inner join Personal on Personal.Nombre_Usuario = Usuarios.usuario where Usuarios.nivel = '4' ".$In."";
					$Supervisores = $db->select($sql);
					foreach($Supervisores as $Supervisor){
						if($Supervisor["Nombre"] != ""){
							$ToReturn .= "<option value='E_".$Supervisor["Id_Personal"]."'>".$Supervisor["Nombre"]."</option>";
						}
					}
				$ToReturn .= "</optgroup>";
			break;
		}
		return $ToReturn;
	}
	function SeparateByRuts($idCola, $Rows){
		$Algoritmo = "0";
		$db = new DB();
		$Cedente = $_SESSION['cedente'];
		$SqlCola = "select Rut from QR_".$Cedente."_".$idCola;
		$Ruts = $db->select($SqlCola);
		$NumRuts = count($Ruts);
		$CantRutsAvailable = $NumRuts;
		$ArrayAsignacion = array();
		$Prefix = "QR_".$Cedente."_".$idCola."_";
		$this->DeleteTablesFromCola($Prefix);
		foreach($Rows as $Row){
			$Nombre = $Row[0];
			$Porcentaje = $Row[1];
			$Porcentaje = $Porcentaje / 100;
			$Foco = $Row[3];
			$Id = $Row[2];
			$TotalRuts = ceil($NumRuts * $Porcentaje);
			if($CantRutsAvailable <= $TotalRuts){
				$TotalRuts = $CantRutsAvailable;
			}
			$CantRutsAvailable = $CantRutsAvailable - $TotalRuts;
			$ArrayAsignacion[$Id]["Porcentaje"] = $Porcentaje * 100;
			$ArrayAsignacion[$Id]["TotalRuts"] = $TotalRuts;
			$ArrayAsignacion[$Id]["Ruts"] = array();
			$Cont = 1;
			foreach($Ruts as $Key => $Rut){
				if($Cont <= $TotalRuts){
					array_push($ArrayAsignacion[$Id]["Ruts"],$Rut["Rut"]);
					$Cont++;
					unset($Ruts[$Key]);
				}else{
					break;
				}
			}
			$TaqbleName = "`QR_".$Cedente."_".$idCola."_".$Id."_".($Porcentaje * 100)."_".$Algoritmo."_".$Foco."`";
			$RutsArray = $ArrayAsignacion[$Id]["Ruts"];
			foreach($RutsArray as $Key => $Rut){
				$RutsArray[$Key] = "(".$Rut.")";
			}
			$RutsImplode = implode(",",$RutsArray);
			$fecha_traza = date('Y-m-d');
			$crear = "CREATE TABLE $TaqbleName (id INT NOT NULL AUTO_INCREMENT, Rut INT, estado INT NOT NULL DEFAULT 0, KEY (id))";
			$InsertTable = $db->query($crear);
			if($InsertTable){
				$SqlInsert = "INSERT INTO $TaqbleName (Rut) values ".$RutsImplode;
				$Insert = $db->query($SqlInsert);
			}
		}
		$Tipos = array();
		$Tipos["Tipo1"] = array();
		$Tipos["Tipo2"] = array();
		foreach($ArrayAsignacion as $key => $Entidad){
			$Ruts = $Entidad["Ruts"];
			$File = array();
				$File[$key] = $this->CrearArchivoAsignacion($key,$Ruts);
			array_push($Tipos["Tipo1"],$File[$key]);
			$File = array();
				$File[$key] = $this->CrearArchivoAsignacionTipo2($key,$Ruts);
			array_push($Tipos["Tipo2"],$File[$key]);
		}
		echo json_encode($Tipos);
	}
	function SeparateByDeuda($idCola, $Rows){
		$Algoritmo = "1";
		$db = new DB();
		$Rows = array_sort($Rows, 1, SORT_DESC);
		$Cedente = $_SESSION['cedente'];
		$SqlCola = "select Rut as Rut, Sum(Monto_Mora) as Deuda from Deuda where Id_Cedente = '".$Cedente."' and Rut in (select Rut from QR_".$Cedente."_".$idCola.") Group By Rut";
		$Deudas = $db->select($SqlCola);
		$CantTotalDeudas = $this->DeudaTotal($Deudas);
		$CantDeudasAvailable = $CantTotalDeudas;
		$ArrayAsignacion = array();
		$Prefix = "QR_".$Cedente."_".$idCola."_";
		$this->DeleteTablesFromCola($Prefix);
		foreach($Rows as $Row){
			$Nombre = $Row[0];
			$Porcentaje = $Row[1];
			$Porcentaje = $Porcentaje / 100;
			$Foco = $Row[3];
			$Id = $Row[2];
			$TotalDeudas = ($CantTotalDeudas * $Porcentaje);
			if($CantDeudasAvailable <= $TotalDeudas){
				$TotalDeudas = $CantDeudasAvailable;
			}
			$ArrayAsignacion[$Id]["Ruts"] = array();
			$SumDeuda = 0;
			foreach($Deudas as $Key => $Deuda){
				if($SumDeuda <= $TotalDeudas){
					$SumDeuda += $Deuda["Deuda"];
					array_push($ArrayAsignacion[$Id]["Ruts"],$Deuda["Rut"]);
					unset($Deudas[$Key]);
				}else{
					break;
				}
			}
			$TaqbleName = "`QR_".$Cedente."_".$idCola."_".$Id."_".($Porcentaje * 100)."_".$Algoritmo."_".$Foco."`";
			$RutsArray = $ArrayAsignacion[$Id]["Ruts"];
			foreach($RutsArray as $Key => $Rut){
				$RutsArray[$Key] = "(".$Rut.")";
			}
			$RutsImplode = implode(",",$RutsArray);
			$fecha_traza = date('Y-m-d');
			$crear = "CREATE TABLE $TaqbleName (id INT NOT NULL AUTO_INCREMENT, Rut INT, estado INT NOT NULL DEFAULT 0, KEY (id))";
			$InsertTable = $db->query($crear);
			if($InsertTable){
				$SqlInsert = "INSERT INTO $TaqbleName (Rut) values ".$RutsImplode;
				$Insert = $db->query($SqlInsert);
			}
		}
		$Tipos = array();
		$Tipos["Tipo1"] = array();
		$Tipos["Tipo2"] = array();
		foreach($ArrayAsignacion as $key => $Entidad){
			$Ruts = $Entidad["Ruts"];
			$File = array();
				$File[$key] = $this->CrearArchivoAsignacion($key,$Ruts);
			array_push($Tipos["Tipo1"],$File[$key]);
			$File = array();
				$File[$key] = $this->CrearArchivoAsignacionTipo2($key,$Ruts);
			array_push($Tipos["Tipo2"],$File[$key]);
		}
		echo json_encode($Tipos);
	}
	function DeudaTotal($Deudas){
		$ToReturn = 0;
		foreach($Deudas as $Deuda){
			$ToReturn += $Deuda["Deuda"];
		}
		return $ToReturn;
	}
	function DeleteTablesFromCola($Prefix){
		$db = new DB();
		$SqlTables = "select TABLE_NAME as tabla from information_schema.TABLES where TABLE_SCHEMA='foco' and TABLE_NAME like '".$Prefix."%'";
		$Tables = $db->select($SqlTables);
		if(count($Tables) > 0){
			foreach($Tables as $Table){
				$Tabla = $Table["tabla"];
				$Sql = "drop table `".$Tabla."`";
				$db->query($Sql);
			}
		}
	}
	
	function CrearArchivoAsignacion($fileName,$Ruts){
		$objPHPExcel = new PHPExcel();
		$db = new DB();
		$fileName = $this->getEntidadName($fileName);
		ob_start();
		$objPHPExcel->
			getProperties()
				->setCreator("FOCO Estrategico")
				->setLastModifiedBy("FOCO Estrategico");
		
		$objPHPExcel->removeSheetByIndex(
			$objPHPExcel->getIndex(
				$objPHPExcel->getSheetByName('Worksheet')
			)
		);

		$NextSheet = 0;

		$objPHPExcel->createSheet($NextSheet);
		$objPHPExcel->setActiveSheetIndex($NextSheet);
		$objPHPExcel->getActiveSheet()->setTitle('Personas');

		$objPHPExcel->
		setActiveSheetIndex($NextSheet)
                ->setCellValueByColumnAndRow(0,1,"Rut")
				->setCellValueByColumnAndRow(1,1,"DV")
				->setCellValueByColumnAndRow(2,1,"Nombre Completo");

		$RutsImplode = implode(",",$Ruts);
		$SqlPersonas = "select * from Persona where Rut in (".$RutsImplode.")";
		$Personas = $db->select($SqlPersonas);
		
		$Cont = 2;
		foreach($Personas as $Persona){
			$objPHPExcel->
			setActiveSheetIndex($NextSheet)
					->setCellValueByColumnAndRow(0,$Cont,$Persona["Rut"])
					->setCellValueByColumnAndRow(1,$Cont,$Persona["Digito_Verificador"])
					->setCellValueByColumnAndRow(2,$Cont,$Persona["Nombre_Completo"]);
			$Cont++;
		}

		$NextSheet++;

		$objPHPExcel->createSheet($NextSheet);
		$objPHPExcel->setActiveSheetIndex($NextSheet);
		$objPHPExcel->getActiveSheet()->setTitle('Deudas');

		$objPHPExcel->
		setActiveSheetIndex($NextSheet)
                ->setCellValueByColumnAndRow(0,1,"Rut")
				->setCellValueByColumnAndRow(1,1,"Tipo Deudor")
				->setCellValueByColumnAndRow(2,1,"Producto")
				->setCellValueByColumnAndRow(3,1,"Numero Operacion")
				->setCellValueByColumnAndRow(4,1,"Segmento")
				->setCellValueByColumnAndRow(5,1,"Tramo Dias Mora")
				->setCellValueByColumnAndRow(6,1,"Fecha Vencimiento")
				->setCellValueByColumnAndRow(7,1,"Monto Mora")
				->setCellValueByColumnAndRow(8,1,"Dias Mora")
				->setCellValueByColumnAndRow(9,1,"Fecha Ingreso")
				->setCellValueByColumnAndRow(10,1,"Cuenta");

		$SqlDeudas = "select * from Deuda where Rut in (".$RutsImplode.") and Id_Cedente = '".$_SESSION['cedente']."'";
		$Deudas = $db->select($SqlDeudas);
		
		$Cont = 2;
		foreach($Deudas as $Deuda){
			$objPHPExcel->
			setActiveSheetIndex($NextSheet)
					->setCellValueByColumnAndRow(0,$Cont,$Deuda["Rut"])
					->setCellValueByColumnAndRow(1,$Cont,$Deuda["Tipo_Deudor"])
					->setCellValueByColumnAndRow(2,$Cont,$Deuda["Producto"])
					->setCellValueByColumnAndRow(3,$Cont,$Deuda["Numero_Operacion"])
					->setCellValueByColumnAndRow(4,$Cont,$Deuda["Segmento"])
					->setCellValueByColumnAndRow(5,$Cont,$Deuda["Tramo_Dias_Mora"])
					->setCellValueByColumnAndRow(6,$Cont,$Deuda["Fecha_Vencimiento"])
					->setCellValueByColumnAndRow(7,$Cont,$Deuda["Monto_Mora"])
					->setCellValueByColumnAndRow(8,$Cont,$Deuda["Dias_Mora"])
					->setCellValueByColumnAndRow(9,$Cont,$Deuda["Fecha_Ingreso"])
					->setCellValueByColumnAndRow(10,$Cont,$Deuda["Cuenta"]);
			$Cont++;
		}

		$NextSheet++;

		$objPHPExcel->createSheet($NextSheet);
		$objPHPExcel->setActiveSheetIndex($NextSheet);
		$objPHPExcel->getActiveSheet()->setTitle('Fonos');

		$objPHPExcel->
		setActiveSheetIndex($NextSheet)
                ->setCellValueByColumnAndRow(0,1,"Rut")
				->setCellValueByColumnAndRow(1,1,"Tipo Fono")
				->setCellValueByColumnAndRow(2,1,"Fono");

		$SqlFonos = "select * from fono_cob where Rut in (".$RutsImplode.")";
		$Fonos = $db->select($SqlFonos);
		
		$Cont = 2;
		foreach($Fonos as $Fono){
			$objPHPExcel->
			setActiveSheetIndex($NextSheet)
					->setCellValueByColumnAndRow(0,$Cont,$Fono["Rut"])
					->setCellValueByColumnAndRow(1,$Cont,$Fono["tipo_fono"])
					->setCellValueByColumnAndRow(2,$Cont,$Fono["formato_subtel"]);
			$Cont++;
		}

		$NextSheet++;

		$SqlDirecciones = "select * from Direcciones where Rut in (".$RutsImplode.")";
		$Direcciones = $db->select($SqlDirecciones);
		if(count($Direcciones) > 0){
			$objPHPExcel->createSheet($NextSheet);
			$objPHPExcel->setActiveSheetIndex($NextSheet);
			$objPHPExcel->getActiveSheet()->setTitle('Direcciones');

			$objPHPExcel->
			setActiveSheetIndex($NextSheet)
					->setCellValueByColumnAndRow(0,1,"Rut")
					->setCellValueByColumnAndRow(1,1,"Direccion")
					->setCellValueByColumnAndRow(2,1,"Codigo Postal")
					->setCellValueByColumnAndRow(3,1,"Complemento Direccion");

			$Cont = 2;
			foreach($Direcciones as $Direccion){
				$objPHPExcel->
				setActiveSheetIndex($NextSheet)
						->setCellValueByColumnAndRow(0,$Cont,$Direccion["Rut"])
						->setCellValueByColumnAndRow(1,$Cont,$Direccion["Direccion"])
						->setCellValueByColumnAndRow(2,$Cont,$Direccion["Complemento_Direccion"])
						->setCellValueByColumnAndRow(3,$Cont,$Direccion["Codigo_postal"]);
				$Cont++;
			}

			$NextSheet++;
		}

		$SqlMails = "select * from Mail where Rut in (".$RutsImplode.")";
		$Mails = $db->select($SqlMails);
		if(count($Mails) > 0){
			$objPHPExcel->createSheet($NextSheet);
			$objPHPExcel->setActiveSheetIndex($NextSheet);
			$objPHPExcel->getActiveSheet()->setTitle('Mails');

			$objPHPExcel->
			setActiveSheetIndex($NextSheet)
					->setCellValueByColumnAndRow(0,1,"Rut")
					->setCellValueByColumnAndRow(1,1,"Correo Electronico");

			$Cont = 2;
			foreach($Mails as $Mail){
				$objPHPExcel->
				setActiveSheetIndex($NextSheet)
						->setCellValueByColumnAndRow(0,$Cont,$Mail["rut"])
						->setCellValueByColumnAndRow(1,$Cont,$Mail["correo_electronico"]);
				$Cont++;
			}

			$NextSheet++; 
		}
		$objPHPExcel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="'.$fileName.'.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
		$objWriter->save('php://output');
		$xlsData = ob_get_contents();
		ob_end_clean();
		$response =  array(
			'fileName' => $fileName,
			'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
		);
		return $response;
	}
	function getAsignaciones($idCola){
		$ToReturn = array();
		$db = new DB();
		$Cedente = $_SESSION['cedente'];
		$Prefix = "QR_".$Cedente."_".$idCola."_";
		$SqlTables = "select TABLE_NAME as tabla from information_schema.TABLES where TABLE_SCHEMA='foco' and TABLE_NAME like '".$Prefix."%'";
		$Tables = $db->select($SqlTables);
		foreach($Tables as $Table){
			$Array = array();
			$Tabla = $Table["tabla"];
			$ArrayTabla = explode("_",$Tabla);
			$PrefijoTabla = $ArrayTabla[0];
			$Cedente = $ArrayTabla[1];
			$Cola = $ArrayTabla[2];
			$TipoEntidad = $ArrayTabla[3];
			$idEntidad = $ArrayTabla[4];
			$Porcentaje = $ArrayTabla[5];
			$TipoAsignacion = $ArrayTabla[6];
			$Foco = $ArrayTabla[7];
			$Entidad = $TipoEntidad."_".$idEntidad;
			$Nombre = "";
			$Tipo = "";
			switch($TipoEntidad){
				case 'S':
				case 'E':
					$SqlNombre = "select * from Personal where Id_Personal='".$idEntidad."'";
					$Nombre = $db->select($SqlNombre);
					$Nombre = $Nombre[0]["Nombre"];
					$Tipo = "Personal";
				break;
				case 'EE':
					$SqlNombre = "select * from empresa_externa where IdEmpresaExterna='".$idEntidad."'";
					$Nombre = $db->select($SqlNombre);
					$Nombre = $Nombre[0]["Nombre"];
					$Tipo = "Empresa Externa";
				break;
			}
			$Array["Nombre"] = $Nombre;
			$Array["Tipo"] = $Tipo;
			$Array["Porcentaje"] = $Porcentaje;
			$Array["id"] = $Entidad;
			$Array["Foco"] = $Foco;
			$Array["Actions"] = $Entidad;
			array_push($ToReturn,$Array);
		}
		return $ToReturn;
	}
	function getAsignacionesArchivos($idCola,$Tipo){
		$ToReturn = array();
		$db = new DB();
		$Cedente = $_SESSION['cedente'];
		$Prefix = "QR_".$Cedente."_".$idCola."_";
		$SqlTables = "select TABLE_NAME as tabla from information_schema.TABLES where TABLE_SCHEMA='foco' and TABLE_NAME like '".$Prefix."%'";
		$Tables = $db->select($SqlTables);
		foreach($Tables as $Table){
			$Array = array();
			$Tabla = $Table["tabla"];
			$ArrayTabla = explode("_",$Tabla);
			$PrefijoTabla = $ArrayTabla[0];
			$Cedente = $ArrayTabla[1];
			$Cola = $ArrayTabla[2];
			$TipoEntidad = $ArrayTabla[3];
			$idEntidad = $ArrayTabla[4];
			$Porcentaje = $ArrayTabla[5];
			$TipoAsignacion = $ArrayTabla[6];
			$Foco = $ArrayTabla[7];
			$Entidad = $TipoEntidad."_".$idEntidad;
			$SqlTabla = "select Rut from ".$Tabla;
			$Ruts = $db->select($SqlTabla);
			$RutsTmp = array();
			foreach($Ruts as $Rut){
				array_push($RutsTmp,$Rut["Rut"]);
			}
			$ToReturn[$Entidad] = array();
			switch($Tipo){
				case '1':
					$File = $this->CrearArchivoAsignacion($Entidad,$RutsTmp);
				break;
				case '2':
					$File = $this->CrearArchivoAsignacionTipo2($Entidad,$RutsTmp);
				break;
			}
			array_push($ToReturn[$Entidad],$File);
		}
		return $ToReturn;
	}
	function CrearArchivoAsignacionTipo2($fileName,$Ruts){
		$objPHPExcel = new PHPExcel();
		$db = new DB();
		$fileName = $this->getEntidadName($fileName);
		ob_start();
		$objPHPExcel->
			getProperties()
				->setCreator("FOCO Estrategico")
				->setLastModifiedBy("FOCO Estrategico");
		
		$objPHPExcel->removeSheetByIndex(
			$objPHPExcel->getIndex(
				$objPHPExcel->getSheetByName('Worksheet')
			)
		);

		$NextSheet = 0;

		$objPHPExcel->createSheet($NextSheet);
		$objPHPExcel->setActiveSheetIndex($NextSheet);
		$objPHPExcel->getActiveSheet()->setTitle('Personas');

		$objPHPExcel->
		setActiveSheetIndex($NextSheet)
                ->setCellValueByColumnAndRow(0,1,"Rut")
				->setCellValueByColumnAndRow(1,1,"Nombre Completo")
				->setCellValueByColumnAndRow(2,1,"Fono Especial")
				->setCellValueByColumnAndRow(3,1,"Fono 2")
				->setCellValueByColumnAndRow(4,1,"Fono 3")
				->setCellValueByColumnAndRow(5,1,"Fecha de Vencimiento")
				->setCellValueByColumnAndRow(6,1,"Deuda As400");
		$Cont = 2;
		foreach($Ruts as $Rut){
			$SqlPersonas = "select * from Persona where Rut = '".$Rut."'";
			$Personas = $db->select($SqlPersonas);
			$objPHPExcel->
			setActiveSheetIndex($NextSheet)
					->setCellValueByColumnAndRow(0,$Cont,$Personas[0]["Rut"])
					->setCellValueByColumnAndRow(1,$Cont,$Personas[0]["Nombre_Completo"]);
			
			$SqlFonos = "select fono_cob.* from SIS_Categoria_Fonos inner join fono_cob on fono_cob.color = SIS_Categoria_Fonos.color where fono_cob.rut = '".$Rut."' order by SIS_Categoria_Fonos.prioridad limit 3";
			$Fonos = $db->select($SqlFonos);
			$FonosTmp = array();
			foreach($Fonos as $Fono){
				array_push($FonosTmp,$Fono["formato_subtel"]);
			}
			$FonoEspecial = isset($FonosTmp[0]) ? $FonosTmp[0] : "";
			$Fono2 = isset($FonosTmp[2]) ? $FonosTmp[2] : "";
			$Fono3 = isset($FonosTmp[3]) ? $FonosTmp[3] : "";
			$objPHPExcel->
			setActiveSheetIndex($NextSheet)
					->setCellValueByColumnAndRow(2,$Cont,$FonoEspecial)
					->setCellValueByColumnAndRow(3,$Cont,$Fono2)
					->setCellValueByColumnAndRow(4,$Cont,$Fono3);
			
			$SqlVencimientoDeuda = "select min(Fecha_Vencimiento) as Vencimiento from Deuda where Rut='".$Rut."' and Id_Cedente='".$_SESSION['cedente']."'";
			$VencimientoDeuda = $db->select($SqlVencimientoDeuda);
			$objPHPExcel->
			setActiveSheetIndex($NextSheet)
					->setCellValueByColumnAndRow(5,$Cont,$VencimientoDeuda[0]["Vencimiento"]);

			$SqlTotalDeuda = "select sum(Monto_Mora) as Total from Deuda where Rut='".$Rut."' and Id_Cedente='".$_SESSION['cedente']."'";
			$TotalDeuda = $db->select($SqlTotalDeuda);
			$objPHPExcel->
			setActiveSheetIndex($NextSheet)
					->setCellValueByColumnAndRow(6,$Cont,$TotalDeuda[0]["Total"]);
			$Cont++;
		}
		$objPHPExcel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="'.$fileName.'.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
		$objWriter->save('php://output');
		$xlsData = ob_get_contents();
		ob_end_clean();
		$response =  array(
			'fileName' => $fileName,
			'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
		);
		return $response;
	}
	function getEntidadName($Entidad){
		$db = new DB();
		$ToReturn = $Entidad;
		$ArrayEntidad = explode("_",$Entidad);
		switch($ArrayEntidad[0]){
			case 'S':
			case 'E':
				$Sql = "select Nombre as Nombre from Personal where Id_Personal = '".$ArrayEntidad[1]."'";
			break;
			case 'EE':
				$Sql = "select Nombre as Nombre from empresa_externa where IdEmpresaExterna = '".$ArrayEntidad[1]."'";
			break;
		}
		$Entidad = $db->select($Sql);
		$ToReturn = $ArrayEntidad[0]."_".$Entidad[0]["Nombre"];
		return $ToReturn;
	}
}
?>