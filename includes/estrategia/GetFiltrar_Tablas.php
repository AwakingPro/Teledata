<?php
include_once("../../includes/functions/Functions.php");
include_once("../../class/estrategia/config_tablas.php");
QueryPHP_IncludeClasses("db");
$ConfigTablas = new ConfigTablas();
$tablas = $ConfigTablas->getFiltrar_tablas($_POST['idCedente']);
$ToReturn = "<option value='0'>Seleccione</option>";
foreach($tablas as $tabla){
    if($tabla["nombre"] != ""){
        $ToReturn .= "<option value='".$tabla["id_tabla"]."'>".$tabla["nombre"]."</option>";
    }
}
echo $ToReturn;
?>