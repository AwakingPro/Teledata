<?php
include_once("../../includes/functions/Functions.php");
include_once("../../class/trabajador/trabajador.php");
QueryPHP_IncludeClasses("db");
$trabajador = new Trabajador();
$cargos = $trabajador->getListarCargos();
$ToReturn = "<option value='0'>Seleccione</option>";
foreach($cargos as $cargo){
    if($cargo["cargo"] != ""){
        $ToReturn .= "<option value='".$cargo["id_cargo"]."'>".$cargo["cargo"]."</option>";
    }
}
echo $ToReturn;
?>