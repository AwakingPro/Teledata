<?php 
include("../../class/estrategia/estrategias.php");
$Estrategia = new Estrategia();
$Estrategia->CrearQuery($_POST['Valor'],$_POST['Logica'],$_POST['NombreCola'],$_POST['IdColumna'],$_POST['IdCedente'],$_POST['IdEstrategia'],$_POST['IdSubQuery'],$_POST['IdTabla']);
?>    