<?php
include("../../class/reporte/reporteClass.php");

$Reporte = new Reporte();
$Reporte->mostrarReporteOnce($_POST['fecha'],$_POST['cedente']);

?>