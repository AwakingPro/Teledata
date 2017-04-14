<?php
include("../../class/tareas/tareas.php");
$tareas = new Tareas();
$tareas->activarCola($_POST['id']);
?>