<?php
include("../../class/estrategia/estrategia.php");

$estrategia = new Estrategia();
$estrategia->asignarRelacion($_POST['tablas'],$_POST['id_estrategia'],$_POST['columnas'],addslashes($_POST['logica']),$_POST["valor"],$_POST['siguiente_nivel'],$_POST['nombre_nivel'],$_POST['id_clases'],$_POST['cedente']);
$estrategia->mostrarRelacion();

?>