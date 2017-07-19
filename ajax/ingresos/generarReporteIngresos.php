<?php
/** Incluir la libreria PHPExcel */
require_once '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
	->setCreator("Teledata")
	->setLastModifiedBy("Teledata")
	->setTitle("Nota de Venta")
	->setSubject("Reporte de Ingresos")
	->setDescription("Reporte de Ingresos.")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Reporte de Ingresos");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', 'Fecha de Compra')
	->setCellValue('B1', 'Fecha de Ingreso')
	->setCellValue('C1', 'Proveedor')
	->setCellValue('D1', 'Numero de Factura')
	->setCellValue('E1', 'Modelo')
	->setCellValue('F1', 'Cantidad')
	->setCellValue('G1', 'Numero de Serie')
	->setCellValue('H1', 'Mac Address')
	->setCellValue('I1', 'Estado')
	->setCellValue('J1', 'Valor')
	->setCellValue('K1', 'Bodega');


foreach (range(0, 5) as $col) {
	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}


$ids = $_GET['ids'];
$array = explode(',',$ids);

require_once('../../class/methods_global/methods.php');
$query = "	SELECT inventario_ingresos.*, 
				mantenedor_modelo_producto.nombre as modelo, 
				mantenedor_marca_producto.nombre as marca, 
				mantenedor_tipo_producto.nombre as tipo, 
				mantenedor_proveedores.nombre as proveedor, 
				mantenedor_bodegas.nombre as bodega 
			FROM inventario_ingresos 
				INNER JOIN mantenedor_modelo_producto ON inventario_ingresos.modelo_producto_id = mantenedor_modelo_producto.id 
				INNER JOIN mantenedor_marca_producto ON mantenedor_modelo_producto.marca_producto_id = mantenedor_marca_producto.id 
				INNER JOIN mantenedor_tipo_producto ON mantenedor_marca_producto.tipo_producto_id = mantenedor_tipo_producto.id 
				INNER JOIN mantenedor_bodegas ON inventario_ingresos.bodega_id = mantenedor_bodegas.id 
				LEFT JOIN mantenedor_proveedores ON inventario_ingresos.proveedor_id = mantenedor_proveedores.id 
			WHERE inventario_ingresos.id IN (".implode(',', $array).")
			GROUP BY inventario_ingresos.id";

$run = new Method;
$ingresos = $run->select($query);

// echo '<pre>'; print_r($ingresos); echo '</pre>';


if (count($ingresos) > 0) {

	$index = 2;

	foreach($ingresos as $ingreso){

		if($ingreso['fecha_compra'] && $ingreso['fecha_compra'] != '0000-00-00'){
            $fecha_compra = \DateTime::createFromFormat('Y-m-d',$ingreso['fecha_compra'])->format('d-m-Y');
        }else{
            $fecha_compra = '';
        }
        
        $fecha_ingreso = \DateTime::createFromFormat('Y-m-d',$ingreso['fecha_ingreso'])->format('d-m-Y');

        if($ingreso['estado'] == 1){
            $estado = 'Nuevo';
        }else{
            $estado = 'Reacondicionado';
        }

        if($ingreso['proveedor']){
            $proveedor = $ingreso['proveedor'];
        }else{
            $proveedor = '';
        }

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$index, $fecha_compra)
		->setCellValue('B'.$index, $fecha_ingreso)
		->setCellValue('C'.$index, $proveedor)
		->setCellValue('D'.$index, $ingreso['numero_factura'])
		->setCellValue('E'.$index, $ingreso['tipo'] . ' ' . $ingreso['marca'] . ' ' . $ingreso['modelo'])
		->setCellValue('F'.$index, $ingreso['cantidad'])
		->setCellValue('G'.$index, $ingreso['numero_serie'])
		->setCellValue('H'.$index, $ingreso['mac_address'])
		->setCellValue('I'.$index, $estado)
		->setCellValue('J'.$index, $ingreso['valor'])
		->setCellValue('K'.$index, $ingreso['bodega']);

		$index++;
	}

}

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Ingresos');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../../reportes/ingresos/Reporte '.date("d-m-Y").'.xlsx');
exit;
?>