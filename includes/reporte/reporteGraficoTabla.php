<?php 
include("../../class/reporte/reporteGestion.php");

$grafico = new Grafico();
$grafico->mostrarTabla($_POST['Cedente'],$_POST['fechaInicio'],$_POST['fechaTermino']);

?>   