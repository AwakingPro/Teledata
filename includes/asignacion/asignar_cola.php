<?php
include("../../class/asignacion/asignacion.php");
$asignar = new Asignacion();
$asignar->asignarCola($_POST['id_cola']);
$asignar->mostrarCola();
?>