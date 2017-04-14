<?php
include("reporteGestiones.php");

$reporte = new Reporte();
$reporte->gestEjecPeriodo($_POST['id'],$_POST['fecha_ini'],$_POST['fecha_fin']);

?>
