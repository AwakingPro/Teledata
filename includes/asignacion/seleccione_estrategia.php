<?php
include("../../class/asignacion/asignacion.php");
$asignar = new Asignacion();
$asignar->asignarEstrategia($_POST['id']);
$asignar->mostrarEstrategia();
?>