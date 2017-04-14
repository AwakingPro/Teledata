<?php
include("../db/db.php");
include("../class/tareas/tareas.php");

$tareas = new Tareas();
$tareas->actualizarCola();

?>