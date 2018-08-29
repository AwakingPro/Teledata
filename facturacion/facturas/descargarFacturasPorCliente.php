<?php
    include('../../class/methods_global/methods.php');
    if(isset($_GET['documentType'])){
		$documentType = $_GET['documentType'];
	}else{
		$documentType = '';
    }
    $Rut = $_GET['Rut'];

    $query = "  SELECT
                    facturas.Id
                FROM
                    facturas
                    INNER JOIN mantenedor_tipo_cliente ON facturas.TipoDocumento = mantenedor_tipo_cliente.Id 
                    INNER JOIN personaempresa ON facturas.Rut = personaempresa.rut 
                WHERE
                    facturas.Rut = '".$Rut."'
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
            $file = $Id.'.pdf';
            if(file_exists($file)){
                // $zip->addFromString(basename($file),  file_get_contents($file)); 
                $zip->addFile($file);
            }
            // else{
            //     echo $file;
            //     return;
            // }
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
        echo 'No hay documentos correspondientes a este cliente';
    }
?>