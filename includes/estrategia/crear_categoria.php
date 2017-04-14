<?php
include("../../class/estrategia/estrategia.php");

$estrategia = new Estrategia();
$estrategia->asignarCategoriaColor($_POST['color'],$_POST['nombre'],$_POST['comentario']);

?>
