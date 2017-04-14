<?php 
include("graficoTabla.php");

$grafico = new Grafico();
$grafico->mostrarTabla($_POST['cedente'],$_POST['cola'],$_POST['periodo']);

?>   