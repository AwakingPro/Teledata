<?php
/** Incluir la libreria PHPExcel */
require_once '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';
require_once '../../class/methods_global/methods.php';
// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Teledata")
->setLastModifiedBy("Teledata")
->setTitle("Documento Excel Libro de Ventas Teledata")
->setSubject("Documento Excel Libro de Ventas Teledata")
->setDescription("Informe Libro de Ventas Teledata .")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Informe Libro de Ventas Teledata");

// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Tipo Docto')
->setCellValue('B1', 'Nº Docto')
->setCellValue('C1', 'RUT Receptor')
->setCellValue('D1', 'Receptor Documento')
->setCellValue('E1', 'Fecha Emisión')
->setCellValue('F1', 'Monto Neto')
->setCellValue('G1', 'IVA')
->setCellValue('H1', 'Monto Total')
->setCellValue('I1', 'Enviado SII')
->setCellValue('J1', 'Aceptado SII')
->setCellValue('K1', 'Estado del DTE');

foreach (range(0, 10) as $col) {
        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
}

$FechaEmision = '';
$IVA = 0;


	$query = "	SELECT
					mt.nombre AS TipoDocumento,
                    f.NumeroDocumento,
					p.rut,
					p.nombre,
                    (SELECT SUM( Valor ) FROM facturas_detalle WHERE FacturaId = f.Id ) AS MontoNeto,
                    f.FechaFacturacion as FechaEmision,
                    (SELECT SUM( Total ) FROM facturas_detalle WHERE FacturaId = f.Id ) AS MontoTotal
                     
				FROM
					personaempresa p
                INNER JOIN 
					mantenedor_tipo_cliente mt 
				ON
					p.tipo_cliente = mt.id
                INNER JOIN 
                    facturas f 
				ON 
                    p.rut = f.Rut
                WHERE
                    f.EstatusFacturacion = '1' ";

// -- quitar el group by si quiero mostrar cada factura de cada cliente
//                 -- GROUP BY p.rut
// 				-- ORDER BY
//                 --     p.nombre 

if(!isset($_GET['startDate']) && !isset($_GET['endDate'])){
    $query .= " ORDER BY p.nombre ";
}

if(isset($_GET['startDate']) && isset($_GET['endDate'])){
    $startDate = $_GET['startDate'];
    $dt = \DateTime::createFromFormat('d-m-Y',$startDate);
    $startDate = $dt->format('Y-m-d');
    $endDate = $_GET['endDate'];
    $dt = \DateTime::createFromFormat('d-m-Y',$endDate);
    $endDate = $dt->format('Y-m-d');

    $query .= " AND f.FechaFacturacion BETWEEN '".$startDate."' AND '".$endDate."' ORDER BY p.nombre ";
}

$run = new Method;
$data = $run->select($query);
if(count($data) > 0) {
    // echo var_dump($data); return;
	$index = 2;
	for ($i=0; $i < count($data) ; $i++) {
        // print_r($data[$i]); return;
        $IVA = $data[$i][5] * 0.19;
        $FechaEmision = \DateTime::createFromFormat('Y-m-d',$data[$i][5])->format('d-m-Y');
       
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$index, $data[$i][0])
		->setCellValue('B'.$index, $data[$i][1])
		->setCellValue('C'.$index, $data[$i][2])
        ->setCellValue('D'.$index, $data[$i][3])
        ->setCellValue('E'.$index, $FechaEmision)
        ->setCellValue('F'.$index, $data[$i][4])
        ->setCellValue('G'.$index, $IVA)
        ->setCellValue('H'.$index, $data[$i][6])
        ->setCellValue('I'.$index, 'En Proceso')
        ->setCellValue('J'.$index, 'En Proceso')
        ->setCellValue('K'.$index, 'En Proceso');

		$index ++;
    }
}
else
{
    echo "No existen datos para esta consulta";
    return;
}

// Renombrar Hoja, no tener mas de 35 caracteres.
$objPHPExcel->getActiveSheet()->setTitle('Libro de Ventas Teledata');



// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Libro de Ventas.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>