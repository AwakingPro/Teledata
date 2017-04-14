<?php
	include_once("../../db/db.php");
	if(!isset($_SESSION)){
		session_start();
	}

	$CamposPOST = $_POST['campos'];
	$FechaCargaCont = 0;
	$valores = array();
	switch($_POST['tabla']){
		case 'fono_cob_tmp':
			array_push($CamposPOST,"fecha_carga");
			$FechaCargaCont++;
		break;
	}
	if (substr($_POST['doc'], strrpos($_POST['doc'], ".")) == ".csv") {
		$contador = 0;
		$fp = fopen ($_POST['doc'],"r");
		while ($data = fgetcsv ($fp, 1000, ";")) {
			if ($contador > 0) {
				$values = array();
				$num = count ($data);
				for ($i=0; $i < $num; $i++) {
					if ($CamposPOST[$i] != "") {
						$values[] = $data[$i];
					}
				}
				$valores[] = '("'.implode('","', $values).'")';
			}
			$contador ++;
		}
		$campos =  array_filter($CamposPOST);
		echo $sql ='INSERT INTO '.$_POST['tabla'].' ('.implode(",", $campos).') VALUES '.implode(',', $valores).';';

	}else{

		require '../../plugins/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

		$objPHPExcel = PHPExcel_IOFactory::load($_POST['doc']);
		$objPHPExcel->setActiveSheetIndex($_POST['sheet']);
		$numColumn = $objPHPExcel->setActiveSheetIndex($_POST['sheet'])->getHighestColumn();
		$numColumn = PHPExcel_Cell::columnIndexFromString($numColumn);
		$numRows = $objPHPExcel->setActiveSheetIndex($_POST['sheet'])->getHighestRow();

		$MontoMoraTotal = 0;

		for ($i=2; $i < $numRows + 1; $i++) {
			$values = array();
			$CanCreate = true;
			for ($j = 0; $j < $numColumn + $FechaCargaCont; $j++) {
				if ($CamposPOST[$j] != "") {
					switch($CamposPOST[$j]){
						case 'fecha_carga':
							$val = "NOW()";
						break;
						default:
							$cell =$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j, $i);
							$val= "'".addslashes($cell->getValue())."'";
							if(PHPExcel_Shared_Date::isDateTime($cell)) {
								$date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($cell->getValue()));
								if(validateDate($date)){
									$val = "'".addslashes($date)."'";
								}
							}
							switch($_POST['tabla']){
								case 'Deuda_tmp':
									switch($CamposPOST[$j]){
										case 'Monto_Mora':
											$MontoMoraTotal += floatval(str_replace("'","",$val));
										break;
									}
								break;
							}
						break;
					}
					/*if(ExistPK($_POST['listTag'])){
						if(!SearchInArray($valores,$val,getPKIndex($CamposPOST,$_POST['listTag']))){
							$values[] = $val;
						}else{
							$CanCreate = false;
						}
					}else{
						$values[] = $val;
					}*/
					$values[] = $val;
				}
			}
			if($CanCreate){
				switch($_POST['tabla']){
					case 'Persona_tmp':
						array_push($values,$_SESSION['cedente']);
					break;
					case 'Deuda_tmp':
						array_push($values,$_SESSION['cedente']);
					break;
					case 'fono_cob_tmp':
						array_push($values,$_SESSION['cedente']);
					break;
					case 'Direcciones_tmp':
						array_push($values,$_SESSION['cedente']);
					break;
					case 'Mail_tmp':
						array_push($values,$_SESSION['cedente']);
					break;
				}
				$valores[] = "(".implode(",", $values).")";
			}
		}
		$campos =  array_filter($CamposPOST);
		switch($_POST['tabla']){
			case 'Persona_tmp':
				array_push($campos,"Id_Cedente");
			break;
			case 'Deuda_tmp':
				array_push($campos,"Id_Cedente");
			break;
			case 'fono_cob_tmp':
				array_push($campos,"Id_Cedente");
			break;
			case 'Direcciones_tmp':
				array_push($campos,"Id_Cedente");
			break;
			case 'Mail_tmp':
				array_push($campos,"Id_Cedente");
			break;
		}
		$ToReturn = array();
		$ToReturn["Query"] = "";
		foreach($valores as $Valor){
			$SQL = "INSERT INTO ".$_POST['tabla']." (".implode(",", $campos).") VALUES ".$Valor;
			$ToReturn["Query"] .= "<br>". $SQL;
			try {
				mysql_query($SQL);

			}catch(Exeption $ex){

			}

		}
		/*$sql ='INSERT INTO '.$_POST['tabla'].' ('.implode(",", $campos).') VALUES '.implode(',', $valores).';';
		$ToReturn["Query"] = $sql;
		$resultado = mysql_query($sql);
		if ($resultado) {
			$ToReturn["Result"] = "1";
		}else{
			$ToReturn["Result"] = "0";
		}*/
		$ToReturn["Result"] = "1";
		echo json_encode($ToReturn);
	}
	function SearchInArray($ArrayValues,$Value,$index){
		$ToReturn = false;
		$BoolFlag = false;
		$Cont = 0;
		$Value = str_replace("'","",$Value);
		foreach($ArrayValues as $ArrayValue){
			$String = $ArrayValue;
			$String = str_replace("(","",$String);
			$String = str_replace("(","",$String);
			$String = str_replace("'","",$String);
			$Array = explode(",",$String);
			if($Array[$index] == $Value){
				$Cont++;
			}else{
			}
		}
		if($Cont > 0){
			$ToReturn = true;
		}
		return $ToReturn;
	}
	function getPKIndex($campos,$Pk){
		$Index = 0;
		$CamposCont = 0;
		foreach($campos as $campo => $ValueCampo){
			if($ValueCampo != ""){
				if($Pk[$campo] == "1"){
					$Index = $CamposCont;
				}
				$CamposCont++;
			}
		}
		return $Index;
	}
	function ExistPK($Pk){
		$ToReturn = false;
		foreach($Pk as $value){
			if($value == "1"){
				$ToReturn = true;
			}
		}
		return $ToReturn;
	}
	function validateDate($date, $format = 'Y-m-d'){
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
 ?>