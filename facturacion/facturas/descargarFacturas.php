<?php
    include('../../class/methods_global/methods.php');

    $zipname = time().'.zip';
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);
    $run = new Method;

    if(isset($_GET['documentType'])){
		$documentType = $_GET['documentType'];
	}else{
		$documentType = '';
	}
	if(isset($_GET['startDate'])){
		$startDate = $_GET['startDate'];
		$endDate = $_GET['endDate'];
	}else{
		$startDate = '';
		$endDate = '';
	}
	if(isset($_GET['Rut'])){
		$Rut = $_GET['Rut'];
	}else{
		$Rut = '';
	}
	if(isset($_GET['NumeroDocumento'])){
		$NumeroDocumento = $_GET['NumeroDocumento'];
	}else{
		$NumeroDocumento = '';
	}

    if(!$documentType OR ($documentType == 1 OR $documentType == 2)){
        $query = "  SELECT
                        facturas.Id,
                        facturas.NumeroDocumento,
                        facturas.TipoDocumento
                    FROM
                        facturas
                        INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id 
                        INNER JOIN personaempresa ON facturas.Rut = personaempresa.rut 
                    WHERE
                        (facturas.EstatusFacturacion = '1' OR facturas.EstatusFacturacion = '2')";
        if($startDate){
            $dt = \DateTime::createFromFormat('Y/m/d',$startDate);
            $startDate = $dt->format('Y-m-d');
            $dt = \DateTime::createFromFormat('Y/m/d',$endDate);
            $endDate = $dt->format('Y-m-d');
            $query .= " AND facturas.FechaFacturacion BETWEEN '".$startDate."' AND '".$endDate."'";
        }
        if($Rut){
            $query .= " AND facturas.Rut = '".$Rut."'";
        }
        if($documentType){
            $query .= " AND facturas.TipoDocumento = '".$documentType."'";
        }
        if($NumeroDocumento){
            $query .= " AND facturas.NumeroDocumento = '".$NumeroDocumento."'";
        }
        $facturas = $run->select($query);
        
        if($facturas){
            foreach($facturas as $factura){
                $Id = $factura['Id'];
                $file = $Id.'.pdf';
                if(file_exists($file)){
                    $TipoDocumento = $factura['TipoDocumento'];
                    $NumeroDocumento = $factura['NumeroDocumento'];
                    if($TipoDocumento == 1){
                        $TipoDocumento = 'Boleta';
                    }else{
                        $TipoDocumento = 'Factura';
                    }
                    $name = $TipoDocumento.'_'.$NumeroDocumento.'.pdf';
                    $zip->addFile($file,$name);
                }
                // else{
                //     echo $file;
                //     return;
                // }
            }
        }
    }
    if(!$documentType OR $documentType == 3){
        $query = "SELECT facturas.Id, devoluciones.NumeroDocumento FROM devoluciones INNER JOIN facturas ON devoluciones.FacturaId = facturas.Id";
        if($startDate){
            $query .= " AND devoluciones.FechaDevolucion BETWEEN '".$startDate."' AND '".$endDate."'";
        }
        if($NumeroDocumento){
            $query .= " AND devoluciones.NumeroDocumento = '".$NumeroDocumento."'";
        }
        $devoluciones = $run->select($query);
        foreach($devoluciones as $devolucion){
            $Id = $devolucion['Id'];
            $file = '/var/www/html/Teledata/facturacion/notas_credito/'.$Id.'.pdf';
            if(file_exists($file)){
                $TipoDocumento = 'Nota_credito';
                $NumeroDocumento = $devolucion['NumeroDocumento'];
                $name = $TipoDocumento.'_'.$NumeroDocumento.'.pdf';
                $zip->addFile($file,$name);
            }
            // else{
            //     echo $file;
            //     return;
            // }
        }
    }
    if($zip->numFiles > 0){
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
        echo 'No hay documentos correspondientes a estos criterios';
    }
?>