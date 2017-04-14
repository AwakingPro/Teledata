<?php
    include("../../includes/functions/Functions.php");
    require '../../plugins/PHPExcel-1.8/Classes/PHPExcel.php';
    
    QueryPHP_IncludeClasses("tareas");
    QueryPHP_IncludeClasses("db");
    $tareas = new Tareas();
    $idCola = $_POST['idCola'];
    $Rows = $_POST['Rows'];
    $tareas->SeparateByDeuda($idCola,$Rows);
?>