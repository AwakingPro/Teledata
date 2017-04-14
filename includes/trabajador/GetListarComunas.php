<?php
include_once("../../includes/functions/Functions.php");
include_once("../../class/trabajador/trabajador.php");
QueryPHP_IncludeClasses("db");
$trabajador = new Trabajador();
$comunas = $trabajador->getListarComunas($_POST['idProvincia']);
$ToReturn = "<option value='0'>Seleccione</option>";
foreach($comunas as $comuna){
    if($comuna["comuna"] != ""){
        $ToReturn .= "<option value='".$comuna["id_comuna"]."'>".$comuna["comuna"]."</option>";
    }
}
echo $ToReturn;
?>