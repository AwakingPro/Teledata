<?php
    include("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("tareas");
    QueryPHP_IncludeClasses("db");
    $tareas = new Tareas();
    $TipoEntidad = $_POST['tipoEntidad'];
    $Array = $_POST['ArrayIds'];
    $Array = implode(",",$Array);
    $Options = $tareas->getEntidades($TipoEntidad,$Array);
    echo $Options;
?>