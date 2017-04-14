<?php
include_once("../../includes/functions/Functions.php");
include_once("../../class/trabajador/trabajador.php");
QueryPHP_IncludeClasses("db");
$trabajador = new Trabajador();
$regiones = $trabajador->getListarRegiones();
$ToReturn = "<option value='0'>Seleccione</option>";
foreach($regiones as $region){
    if($region["region"] != ""){
        $ToReturn .= "<option value='".$region["id_region"]."'>".$region["region"]."</option>";
    }
}
echo $ToReturn;
?>