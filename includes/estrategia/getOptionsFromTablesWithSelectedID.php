<?php
    include_once("../../includes/functions/Functions.php");
    include_once("../../class/estrategia/config_tablas.php");
    QueryPHP_IncludeClasses("db");
    $ConfigTablas = new ConfigTablas();
    $tablas = $ConfigTablas->getOptionsFromTablesWithSelectedID($_POST['table']);
    $ToReturn = "";
    foreach($tablas as $tabla){
        if($tabla["nombre"] != ""){
            $Selected = "";
            if($tabla['id_tabla'] == $_POST['table']){
                $Selected = "selected = 'selected'";
            }
            $ToReturn .= "<option ".$Selected." value='".$tabla["id_tabla"]."'>".$tabla["nombre"]."</option>";
        }
    }
    echo $ToReturn;
?>