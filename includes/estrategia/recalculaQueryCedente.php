<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->RecalculaQueryCedente($_POST['IdCedente']);
?>    