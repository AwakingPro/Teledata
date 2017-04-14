<?php
include("../../class/estrategia/estrategia.php");
$cedente = $_POST['cedente'];
$nombreUsuario = $_POST['nombreUsuario'];
$estrategiasGuardadas = new Estrategia();
$estrategiasGuardadas->estrategiasGuardadas($cedente,$nombreUsuario);
?>
