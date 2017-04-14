<?php
    include_once("../../includes/functions/Functions.php");
    include_once("../../class/estrategia/config_tablas.php");
    QueryPHP_IncludeClasses("db");
    $ConfigTablas = new ConfigTablas();
    $columnas = $ConfigTablas->getOptionsFromColumnsWithSelectedID($_POST['table']);
    $ToReturn = "";
    foreach($columnas as $columna){
        if($columna["columna"] != ""){
            $Selected = "";
            $cedentes = explode(",",$columna["Id_Cedente"]);
            if(in_array($_SESSION['cedente'],$cedentes)){
                $Selected = "selected = 'selected'";
            }
            $ToReturn .= "<option ".$Selected." value='".$columna["id"]."'>".$columna["columna"]."</option>";
        }
    }
    echo $ToReturn;
?>