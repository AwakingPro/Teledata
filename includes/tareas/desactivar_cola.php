<?php
include("../../class/tareas/tareas.php");
$tareas = new Tareas();
$tareas->desactivarCola($_POST['id']);
?>