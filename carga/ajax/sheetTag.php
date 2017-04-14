<?php
	require '../../plugins/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
	$objPHPExcel = PHPExcel_IOFactory::load($_POST['doc']);
	$sheetNames = $objPHPExcel->getSheetNames();
	$objPHPExcel->setActiveSheetIndex($_POST['sheet']);
	$numColumnI = $objPHPExcel->setActiveSheetIndex($_POST['sheet'])->getHighestColumn();
	$numColumnI = PHPExcel_Cell::columnIndexFromString($numColumnI);
	$numRows = $objPHPExcel->setActiveSheetIndex($_POST['sheet'])->getHighestRow();
	for ($i = 0; $i < $numColumnI; $i++) {
		$cell =$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($i, 1);
		$value= $cell->getValue();
		if(PHPExcel_Shared_Date::isDateTime($cell)) {
		     $value = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($value));
		}
		$array[] = $value;
	}
	$list= '<div class="col-md-6"><label>Lista de columnas del Documento</label>';
	for ($i=0; $i < count($array) ; $i++) {
		$list.= '<span class="listTag" id="listTag'.$i.'">'.$array[$i].'<div class="pk Off fa fa-key Off"></div></span>';
	}
	$list.= '</div><div class="col-md-6 form-group"><label >Listas de Campos</label>';
	for ($i=0; $i < count($array) ; $i++) {
		$list.= '<select class="form-control marB15 campos" id="campo'.$i.'" data-live-search="true"><option value="">Seleccione...</option></select>';
	}
	$list.= "</div>";
	echo json_encode($arr = [1,$list,$_POST['doc']]);
 ?>