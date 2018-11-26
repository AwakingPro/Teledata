<?php
$Nombre = 'Daniel';
$TipoDocumento = 'Factura';
$NumeroDocumento = 90;
$espacios2 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
$espacios = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $Html =
                "<html>
                    <head>
                        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
                        <style>
                        body{font-family:Open Sans;font-size:14px;}
                        table{font-size:13px;border-collapse:collapse;}
                        th{padding:8px;text-align:left;color:#595e62;border-bottom: 2px solid rgba(0,0,0,0.14);font-size:14px;}
                        td{padding:8px;border-bottom: 1px solid rgba(0,0,0,0.05);}
                        </style>
                    </head>
                    <body>
                    ESTO ES UNA PRUEBA DE PREFACTURA, <br>
                    ESTIMADO(A) ".$Nombre.",<br>
                        La ".$TipoDocumento." #".$NumeroDocumento." se genero con exito y ha sido adjuntada en este correo.<br><br>
                        <b>Para transferencia o depósitos, los datos de nuestra cuenta son:</b><br><br>
                        RAZÓN SOCIAL:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>TELEDATA CHILE SPA.</b><br>
                        RUT:".$espacios."<b>76.722.248-3</b><br>
                        BANCO:".$espacios2."<b>BANCO DE CHILE</b><br>
                        TIPO DE CUENTA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>CUENTA CORRIENTE</b><br>
                        NUMERO DE CUENTA:&nbsp;<b>268-04500-03</b><br>
                        CORREO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><a href='mailto:pagos@teledata.cl'>pagos@teledata.cl</a></b><br><br>
                        Saludos.
                    </body>
                </html>";
        echo $Html;
?>