<?php
include("../../class/asignacion/asignacion.php");
$asignar = new Asignacion();
$asignar->asignarTipo($_POST['id']);
$asignar->mostrarTipo();
?>