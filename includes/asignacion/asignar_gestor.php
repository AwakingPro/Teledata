<?php
include("../../class/asignacion/asignacion.php");
$asignar = new Asignacion();
$asignar->asignarGestor($_POST['id_gestor']);
$asignar->mostrarGestor();
?>