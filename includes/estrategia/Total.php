<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->Total($_POST['IdCedente']);
?>    