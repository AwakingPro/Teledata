<?php
    if(isset($_GET['documentType'])){
		$documentType = $_GET['documentType'];
	}else{
		$documentType = '';
    }
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];


    $dt = \DateTime::createFromFormat('Y/m/d',$startDate);
    $startDate = $dt->format('Y-m-d');
    $dt = \DateTime::createFromFormat('Y/m/d',$endDate);
    $endDate = $dt->format('Y-m-d');

    $query = "  SELECT
                    facturas.Id
                FROM
                    facturas
                    INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id 
                    INNER JOIN personaempresa ON facturas.Rut = personaempresa.rut 
                WHERE
                    facturas.FechaFacturacion BETWEEN '".$startDate."' AND '".$endDate."'
                    AND facturas.EstatusFacturacion = '1'";
    if($documentType){
        $query .= "AND facturas.TipoDocumento = '".$documentType."'";
    }
    $run = new Method;
    $facturas = $run->select($query);

    if($facturas){
        $zipname = time().'.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach($facturas as $factura){
            $Id = $factura['Id'];
            $file = '/var/www/html/Teledata/facturacion/facturas/'.$Id.'.pdf';
            if(file_exists($file)){
                // $zip->addFromString(basename($file),  file_get_contents($file)); 
                $zip->addFile($file);
            }else{
                echo $file;
                return;
            }
        }
        $filename = $zip->filename;
        $status=$zip->getStatusString();
        $zip->close();
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"".$zipname."\"");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".filesize($filename));
        ob_end_flush();
        @readfile($filename);
    }else{
        echo 'No hay documentos correspondientes a este rango de fecha';
    }
?>