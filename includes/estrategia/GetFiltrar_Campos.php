<?php
include_once("../../includes/functions/Functions.php");
include_once("../../class/estrategia/config_tablas.php");
QueryPHP_IncludeClasses("db");
$ConfigTablas = new ConfigTablas();
$campos = $ConfigTablas->getFiltrar_campos($_POST['idTabla']);
$ToReturn = "<option value='0'>Seleccione</option>";
foreach($campos as $campo){
    if($campo["columna"] != ""){
        $ToReturn .= "<option value='".$campo["id_columna"]."'>".$campo["columna"]."</option>";
    }
}
echo $ToReturn;
?>