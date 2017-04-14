<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->ActualizarCola($_POST['Id'],$_POST['ValorCola']);
?>    