<?php
    require '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';
    $objPHPExcel = new PHPExcel();
    ob_start();
   
   //Informacion del excel
    $objPHPExcel->
        getProperties()
            ->setCreator("FOCO Estrategico")
            ->setLastModifiedBy("FOCO Estrategico");
    
    $Rows = json_decode($_POST['table']);
    foreach($Rows[0] as $Col => $Value){
        //setCellValueByColumnAndRow
            $objPHPExcel->
            setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow($Col,1,$Value);
            //print_r($Value);
    }

    foreach($Rows as $Row => $ValueRow){
        if($Row > 0){
            foreach($ValueRow as $Col => $ValueCol){
                //setCellValueByColumnAndRow
                $objPHPExcel->
                setActiveSheetIndex(0)
                    ->setCellValueByColumnAndRow($Col,$Row + 1,$ValueCol);
                //print_r($Value);
            }
        }
    }
    $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getFont()->setSize(14);
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="ejemplo1.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
    $objWriter->save('php://output');
    $xlsData = ob_get_contents();
    ob_end_clean();
    $response =  array(
        'result' => '1',
        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
    );

die(json_encode($response));
    //exit;
?>