<?php
include("graficoTabla.php");

$grafico = new Grafico();
$grafico->mostrarCedente($_POST['id']);

?>
