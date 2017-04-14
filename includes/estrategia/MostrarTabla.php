<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->MostrarTablas($_POST['IdCedente'],$_POST['IdTipoEstrategia'],$_POST['IdEstrategia']);
?>    