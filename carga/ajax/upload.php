<?php
	$dir_subida = '../doc/';
	$fichero_subido = $dir_subida . basename($_FILES['file']['name']);
	if (move_uploaded_file($_FILES['file']['tmp_name'], $fichero_subido)) {
	    $upload = true;
	} else {
	    $upload = false;
	}
	if ($upload) {
		if (substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], ".")) == ".csv") {
			$list = '<div class="col-md-6"><label>Lista de columnsas del Documento</label>';
			$fp = fopen ($fichero_subido,"r");
			$data = fgetcsv ($fp, 1000, ";");
			$num = count ($data);
			for ($i=0; $i < $num; $i++) {
				$list.= '<span class="listTag">'.$data[$i].'</span>';
			}
			$list.= '</div><div class="col-md-6 form-group"><label >Listas de Campos</label>';
			for ($i=0; $i < $num; $i++) {
				$list.= '<select class="form-control marB15 campos"><option value="">Seleccione...</option></select>';
			}
			$list.= "</div>";
			fclose($fp);
			echo json_encode($arr = [1,$list,$fichero_subido]);
		}else{
			require '../../plugins/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
			$objPHPExcel = PHPExcel_IOFactory::load($fichero_subido);
			$sheetNames = $objPHPExcel->getSheetNames();
			$list = '';
			$sheet = '';
			for ($i=0; $i < count($sheetNames); $i++) {
				$checked = ($i == 0) ? "checked":"";
				$sheet.='<div class="input-group mar-btm">
						<span class="input-group-addon">
							<input  id="radio'.$i.'" class="magic-radio sheet" '.$checked.'  name="sheet" type="radio" value="'.$i.'">
							<label for="radio'.$i.'"></label>
						</span>
						<span class="form-control">'.$sheetNames[$i].'</span>
					</div>';
			}
			$objPHPExcel->setActiveSheetIndex(0);
			$numColumnI = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
			$numColumnI = PHPExcel_Cell::columnIndexFromString($numColumnI);
			$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
			for ($i = 0; $i < $numColumnI; $i++) {
				$cell =$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($i, 1);
				$value= $cell->getValue();
				$array[] = $value;
			}
			$list.= '<div class="col-md-6"><label>Lista de columnas del Documento</label>';
			for ($i=0; $i < count($array) ; $i++) {
				$list.= '<span class="listTag" id="listTag'.$i.'">'.$array[$i].'<div class="pk Off fa fa-key Off"></div></span>';
			}
			$list.= '</div><div class="col-md-6 form-group"><label >Listas de Campos</label>';
			for ($i=0; $i < count($array) ; $i++) {
				$list.= '<select class="form-control marB15 campos" id="campo'.$i.'" data-live-search="true"><option value="">Seleccione...</option></select>';
			}
			$list.= "</div>";
			echo json_encode($arr = [1,$list,$fichero_subido,$sheet]);
		}
	}else{
		echo json_encode($arr = [0,"Error al subir el archivo.",$fichero_subido]);
	}
 ?>
