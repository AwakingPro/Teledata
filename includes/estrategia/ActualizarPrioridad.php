<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->ActualizarPrioridad($_POST['Id'],$_POST['ValorPrioridad']);
?>    