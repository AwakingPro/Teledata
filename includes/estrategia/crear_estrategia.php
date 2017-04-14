<?php
include("../../class/estrategia/estrategias.php");

$estrategia = new Estrategia();
$estrategia->crearEstrategia($_POST['nombre_estrategia'],$_POST['tipo_estrategia'],$_POST['comentario_estrategia'],date('Y-m-d'),date('H:i:s'),$_POST['usuario'],$_POST['cedente'],$_POST['idUsuario']);

?>
