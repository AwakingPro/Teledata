<?php 
include("graficoTabla.php");

$grafico = new Grafico();
$grafico->mostrarEstrategia($_POST['id']);

?>   