<?php
include_once("../../includes/functions/Functions.php");
include_once("../../class/trabajador/trabajador.php");
QueryPHP_IncludeClasses("db");
$trabajador = new Trabajador();
$nacionalidades = $trabajador->getListarNacionalidad();
$ToReturn = "<option value='0'>Seleccione</option>";
foreach($nacionalidades as $nacionalidad){
    if($nacionalidad["nacionalidad"] != ""){
        $ToReturn .= "<option value='".$nacionalidad["id_nacionalidad"]."'>".$nacionalidad["nacionalidad"]."</option>";
    }
}
echo $ToReturn;
?>