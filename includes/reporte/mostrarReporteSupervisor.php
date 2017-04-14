<?php
include("../../class/reporte/reporteClass.php");

$Reporte = new Reporte();
$Reporte->mostrarReporteSupervisor($_POST['cedente']);

?>