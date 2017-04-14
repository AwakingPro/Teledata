<?php
include_once("../../includes/functions/Functions.php");
include_once("../../class/trabajador/trabajador.php");
QueryPHP_IncludeClasses("db");
$trabajador = new Trabajador();
$provincias = $trabajador->getListarProvincias($_POST['idRegion']);
$ToReturn = "<option value='0'>Seleccione</option>";
foreach($provincias as $provincia){
    if($provincia["provincia"] != ""){
        $ToReturn .= "<option value='".$provincia["id_provincia"]."'>".$provincia["provincia"]."</option>";
    }
}
echo $ToReturn;
?>