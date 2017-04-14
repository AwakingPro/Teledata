<?php
include("../../class/estrategia/estrategia.php");

$estrategia = new Estrategia();
$estrategia->asignarColumnas($_POST['id_tabla']);
$estrategia->mostrarColumnas();

?>